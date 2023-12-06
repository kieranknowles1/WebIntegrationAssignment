<?php

namespace App;

// TODO: Should I put the queries in the endpoint classes and remove this?
/**
 * Interface for the `users.sqlite` database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 * @generated ChatGPT was used for additional guidance
 */
class UserDatabase
{
    private static ?UserDatabase $instance = null;
    public static function getInstance(): UserDatabase
    {
        if (self::$instance === null) {
            self::$instance = new UserDatabase(new DatabaseConnection(\Settings::USER_DATABASE_FILE));
        }
        return self::$instance;
    }

    private DatabaseConnection $connection;

    private function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get a user by their email address
     * @return ?array{
     *   'id': int,
     *   'name': string,
     *   'email': string,
     *   'password': string,
     * }
     */
    public function getUserByEmail(string $email): ?array
    {
        $result = $this->connection->runSql("SELECT * FROM account WHERE email = :email", [
            "email" => $email,
        ]);
        if (count($result) === 0) {
            return null;
        } else {
            return $result[0];
        }
    }
}
