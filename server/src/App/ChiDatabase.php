<?php

namespace App;

// TODO: Should I put the queries in the endpoint classes and remove this?
/**
 * Interface for the `chi2023.sqlite` database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 * @generated ChatGPT was used for additional guidance
 */
class ChiDatabase
{
    private static ?ChiDatabase $instance = null;
    public static function getInstance(): ChiDatabase
    {
        if (self::$instance === null) {
            self::$instance = new ChiDatabase(new DatabaseConnection(\Settings::CHI_DATABASE_FILE));
        }
        return self::$instance;
    }

    private DatabaseConnection $connection;

    private function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get all countries in the `affiliations` table
     * @return string[] The countries, ordered alphabetically with no duplicates
     */
    public function getCountries(): array
    {
        $result = $this->connection->runSql("SELECT DISTINCT country FROM affiliation ORDER BY country");
        // Map to a flat array of country names
        return array_map(fn($row) => $row["country"], $result);
    }

    /**
     * Get links to random preview videos and the title of their associated content
     * Items are returned in a random order
     * @param int $limit the maximum number of items to return
     * @return array{'title': string, 'preview_video': string}[] the video URLs and titles
     * ```php
     *  $result[n] = [
     *      "title" => string,
     *      "preview_video" => string
     *  ];
     * ```
     */
    public function getRandomPreviews(int $limit): array
    {
        $query = <<<SQL
        SELECT
            title,
            preview_video
        FROM content
        WHERE preview_video IS NOT NULL
        ORDER BY RANDOM()
        LIMIT :limit
        SQL;

        return $this->connection->runSql($query, ["limit" => $limit]);
    }

    /**
     * Get all content types declared in the `type` table, ordered alphabetically
     * NOTE: This does not necessarily mean that there is any content of that type
     * @return string[]
     */
    public function getContentTypes(): array
    {
        $result = $this->connection->runSql("SELECT name FROM type ORDER BY name");
        // Map to a flat array of type names
        return array_map(fn($row) => $row["name"], $result);
    }

    // /**
    //  * Does a content type with the given name exist in the database?
    //  * NOTE: This does not necessarily mean that there is any content of that type
    //  * @param string $type the name of the type to check, case insensitive
    //  */
    // public function typeExists(string $type): bool
    // {
    //     $query = <<<SQL
    //     SELECT
    //         COUNT(*) AS count
    //     FROM type
    //     WHERE name = :type COLLATE NOCASE
    //     SQL;

    //     $result = $this->connection->runSql($query, ["type" => $type]);
    //     return $result[0]["count"] > 0;
    // }

    /**
     * Does an affiliation with the given country name exist in the database?
     * NOTE: This DOES mean that there is at least one author with that affiliation
     * @param string $country the name of the country to check, case insensitive
     */
    public function countryExists(string $country): bool
    {
        $query = <<<SQL
        SELECT
            COUNT(*) AS count
        FROM affiliation
        WHERE country = :country COLLATE NOCASE
        SQL;

        $result = $this->connection->runSql($query, ["country" => $country]);
        return $result[0]["count"] > 0;
    }

    /**
     * Get the number of content items in the database by type
     * @return array{
     *  'type': string,
     *  'count': int
     * }[] the content counts
     */
    public function getContentCounts(): array
    {
        $query = <<<SQL
        SELECT
            type.name AS type,
            COUNT(content.id) AS count
        -- Select from type and left join to get types with no content
        FROM type
        LEFT JOIN content ON content.type = type.id
        GROUP BY type.id
        SQL;

        return $this->connection->runSql($query);
    }

    public const PAGE_SIZE = 20;
    /**
     * Get information about content in the database, includes title, abstract, and the content type
     * Items are returned ordered by title
     * @param int|null $page the page of 20 items to return, or null to return all items
     * @param string|null $type the name of the type of content to return, or null to return all types. Case insensitive
     * @return array{
     *     'id': int,
     *     'title': string,
     *     'abstract': ?string,
     *     'award': ?string,
     *     'type': string}[] the content information
     */
    public function getContent(?int $page, ?string $type)
    {

        $query = <<<SQL
        SELECT
            content.id,
            content.title,
            content.abstract,
            type.name AS type,
            award.name AS award
        FROM content
        JOIN type ON content.type = type.id
        LEFT JOIN content_has_award ON content.id = content_has_award.content
        LEFT JOIN award ON award.id = content_has_award.award
        SQL;

        $params = [];
        if ($type !== null) {
            $query .= " WHERE type.name = :type COLLATE NOCASE";
            $params["type"] = $type;
        }
        // ORDER BY must come after WHERE
        $query .= " ORDER BY content.title";
        if ($page !== null) {
            $query .= " LIMIT :limit OFFSET :offset";
            $params["limit"] = self::PAGE_SIZE;
            $params["offset"] = $page * self::PAGE_SIZE;
        }

        return $this->connection->runSql($query, $params);
    }

    private const AFFILIATIONS_QUERY_HEAD = <<<SQL
        SELECT
            author.id AS author_id,
            author.name AS author_name,
            affiliation.country AS country,
            affiliation.city AS city,
            affiliation.institution AS institution,
            json_group_array(json_object('id', content.id, 'title', content.title)) AS content
        FROM affiliation
            JOIN content ON content.id = affiliation.content
            JOIN author ON author.id = affiliation.author
    SQL;

    private const AFFILIATIONS_QUERY_TAIL = <<<SQL
        GROUP BY
            affiliation.author,
            affiliation.country,
            affiliation.city,
            affiliation.institution
        ORDER BY
            author.name,
            affiliation.country,
            affiliation.city,
            affiliation.institution
    SQL;

    /**
     * Run a query to get authors and their affiliations from the database
     * @param string $middle the middle of the query, should be a WHERE clause with a trailing space or empty string
     * @param array<string, string|int> $params the parameters to bind to the query
     * @return array{'author_id': int, 'author_name': string, 'country': string, 'city': string, 'institution': string, 'content': array{'id': int, 'title': string}[]}[] the authors and their affiliations
     * ```
     * $result[n] = [
     *    "author_id" => int,
     *    "author_name" => string,
     *    "country" => string,
     *    "city" => string,
     *    "institution" => string,
     *    "content" => [
     *      [ "id" => int, "title" => string]
     *    ] // content
     * ] // result
     */
    private function runAffiliationsQuery(string $middle, array $params): array
    {
        // WHERE needs to be between JOIN and GROUP BY, so splice it in the middle
        $query = self::AFFILIATIONS_QUERY_HEAD . " " . $middle . " " . self::AFFILIATIONS_QUERY_TAIL;
        $result = $this->connection->runSql($query, $params);
        // Decode the content array
        array_walk($result, function (&$row) {
            $row["content"] = json_decode($row["content"]);
        });
        return $result;
    }

    /**
     * Get every affiliation in the database
     * @return array{'author_id': int, 'author_name': string, 'country': string, 'city': string, 'institution': string, 'content': array{'id': int, 'title': string}[]}[] the authors and their affiliations
     */
    public function getAffiliations(): array
    {
        // No filtering here, so just run the query with no WHERE clause
        return self::runAffiliationsQuery("", []);
    }

    /**
     * Get affiliations for a specific piece of content
     * @return array{'author_id': int, 'author_name': string, 'country': string, 'city': string, 'institution': string, 'content': array{'id': int, 'title': string}[]}[] the authors and their affiliations
     */
    public function getAffiliationsByContent(int $contentId): array
    {
        return self::runAffiliationsQuery(
            "WHERE affiliation.content = :content_id",
            ["content_id" => $contentId]
        );
    }

    /**
     * Get affiliations for a specific country
     * @return array{'author_id': int, 'author_name': string, 'country': string, 'city': string, 'institution': string, 'content': array{'id': int, 'title': string}[]}[] the authors and their affiliations
     */
    public function getAffiliationsByCountry(string $countryName): array
    {
        return self::runAffiliationsQuery(
            "WHERE affiliation.country = :country_name COLLATE NOCASE",
            ["country_name" => $countryName
        ]
        );
    }
}
