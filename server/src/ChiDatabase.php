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
}
