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
     * Get a user by their email address.
     * Returns null if the user does not exist
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

    /**
     * Get all notes for a user
     * NOTE: This will return an empty array if the user does not exist or has no notes
     * @param int $userId The ID of the user to get notes for
     * @param int $contentId If set, only notes for this content will be returned
     * @return array{
     *   'id': int,
     *   'content_id': int,
     *   'text': string,
     * }[]
     */
    public function getUserNotes(int $userId, ?int $contentId): array
    {
        return $this->connection->runSql("
            SELECT id, content_id, text
                FROM note
            WHERE user_id = :userId AND (:contentId IS NULL OR content_id = :contentId)
        ", [
            "userId" => $userId,
            "contentId" => $contentId,
        ]);
    }

    /**
     * Create a new note for a user and a piece of content
     * @param int $userId The ID of the user to create the note for
     * @param int $contentId The ID of the content to create the note for
     * @param string $text The text of the note
     * @return string The ID of the new note
     */
    public function createNote(int $userId, int $contentId, string $text): string
    {
        $this->connection->runSql("
             INSERT INTO note (user_id, content_id, text)
             VALUES (:userId, :contentId, :text)
         ", [
            "userId" => $userId,
            "contentId" => $contentId,
            "text" => $text,
        ]);
        return $this->connection->getLastInsertId();
    }

    /**
     * Update a note with a given ID and belonging to a given user
     * @param int $userId The ID of the user to update the note for
     * @param int $noteId The ID of the note to update
     * @param string $text The new text of the note
     * @throws ClientException If the note does not exist or does not belong to the user
     */
    public function updateNoteText(int $userId, int $noteId, string $text): void
    {
        $rowsAffected = $this->connection->runUpdateSql("
            UPDATE note
            SET text = :text
            WHERE id = :noteId AND user_id = :userId
        ", [
            "noteId" => $noteId,
            "userId" => $userId,
            "text" => $text,
        ]);

        // If no rows were affected, the note did not exist or did not belong to the user
        if ($rowsAffected === 0) {
            throw new ClientException(ResponseCode::NOT_FOUND, "Note not found or does not belong to user");
        }
    }

    /**
     * Delete a note with a given ID and belonging to a given user
     * @param int $userId The ID of the user to delete the note for
     * @param int $noteId The ID of the note to delete
     * @throws ClientException If the note does not exist or does not belong to the user
     */
    public function deleteNote(int $userId, int $noteId): void
    {
        $rowsAffected = $this->connection->runUpdateSql("
            DELETE FROM note
            WHERE id = :noteId AND user_id = :userId
        ", [
            "noteId" => $noteId,
            "userId" => $userId,
        ]);

        // If no rows were affected, the note did not exist or did not belong to the user
        if ($rowsAffected === 0) {
            throw new ClientException(ResponseCode::NOT_FOUND, "Note not found or does not belong to user");
        }

        // note.id is a primary key, so it should be impossible for more than one row to be affected
    }
}
