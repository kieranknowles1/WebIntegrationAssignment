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
        return array_map(fn ($row) => $row["country"], $result);
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
     * Does a content type with the given name exist in the database?
     * NOTE: This does not necessarily mean that there is any content of that type
     * @param string $type the name of the type to check, case insensitive
     */
    public function typeExists(string $type): bool
    {
        $query = <<<SQL
        SELECT
            COUNT(*) AS count
        FROM type
        WHERE name = :type COLLATE NOCASE
        SQL;

        $result = $this->connection->runSql($query, ["type" => $type]);
        return $result[0]["count"] > 0;
    }

    public const PAGE_SIZE = 20;
    /**
     * Get information about content in the database, includes title, abstract, and the content type
     * Items are returned ordered by title
     * @param int|null $page the page of 20 items to return, or null to return all items
     * @param string|null $type the name of the type of content to return, or null to return all types. Case insensitive
     * @return array{'title': string, 'abstract': string, 'type': string}[] the content information
     * ```php
     *  $result[n] = [
     *      "title" => string,
     *      "abstract" => string,
     *      "type" => string
     *  ];
     * ```
     */
    public function getContent(?int $page, ?string $type)
    {

        $query = <<<SQL
        SELECT
            content.title,
            content.abstract,
            type.name AS type
        FROM content
        JOIN type ON content.type = type.id
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

    // TODO: Check that this works
    // TODO: Link to the API
    // TODO: Update API docs
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
     * @return array[] the results of the query
     */
    private function runAffiliationsQuery(string $middle, array $params): array
    {
        // WHERE needs to be between JOIN and GROUP BY, so splice it in the middle
        $query = self::AFFILIATIONS_QUERY_HEAD . $middle . self::AFFILIATIONS_QUERY_TAIL;
        $result = $this->connection->runSql($query, $params);
        // Decode the content array
        array_walk($result, function (&$row) {
            $row["content"] = json_decode($row["content"]);
        });
        return $result;
    }
    public function getAffiliations(): array
    {
        // No filtering here, so just run the query with no WHERE clause
        return self::runAffiliationsQuery("", []);
    }

    public function getAffiliationsByContent($contentId): array
    {
        return self::runAffiliationsQuery(
            "WHERE affiliation.content = :content_id ",
            ["content_id" => $contentId]
        );
    }

    public function getAffiliationsByCountry($countryName): array
    {
        return self::runAffiliationsQuery(
            "WHERE affiliation.country = :country_name ",
            ["country_name" => $countryName
        ]
        );
    }
}