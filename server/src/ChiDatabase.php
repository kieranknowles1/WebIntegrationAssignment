<?php

/**
 * Interface for the `chi2023.sqlite` database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ChiDatabase
{
    private static ?ChiDatabase $instance = null;
    public static function getInstance(): ChiDatabase
    {
        if (self::$instance === null) {
            self::$instance = new ChiDatabase(new DatabaseConnection("../data/chi2023.sqlite"));
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
     * @return array[] the video URLs and titles
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
     * @return array[] the content information
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
}
