<?php

namespace App;

/**
 * Represnets a connection to a SQLite database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class DatabaseConnection
{
    private \PDO $pdo;

    public function __construct(string $file)
    {
        $this->pdo = new \PDO("sqlite:$file");
        // Throw exceptions on error
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Run a SQL query and return the result
     * @param string $sql The SQL query to run
     * @param array<string, string|number|bool|null> $params The parameters to pass to the query
     * @return array The result of the query, as an array of associative arrays. Structure depends on the query
     */
    public function runSql(string $sql, array $params = []): array // @phpstan-ignore-line Type depends on query
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
