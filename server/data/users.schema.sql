-- Need to disable foreign keys while dropping tables, saves having to drop them in the right order
PRAGMA foreign_keys = OFF;

-- Exported from users.sqlite
DROP TABLE IF EXISTS account;
CREATE TABLE account (
	id	INTEGER NOT NULL UNIQUE,
	name	TEXT,
	email	TEXT UNIQUE,
	password	TEXT NOT NULL,
	PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO account VALUES
	(1,'John Rooksby','john@example.com','$2y$10$mOtUbFSvNpnlOY2uaZqxqOFzmEy1Q21r5C4YYrak/Cl3wTHIDJece'),
	(2,'Admin','admin@example.com','$2y$10$ihU/y5v.yZYsB/Gekr/BjeJbGsImfXcdg5D/e8Kz51Dni1eA0FnQm');

-- New data
DROP TABLE IF EXISTS note;
CREATE TABLE note (
	id INTEGER NOT NULL PRIMARY KEY,
	user_id INTEGER NOT NULL REFERENCES account(id),
	-- NOTE: Can't use REFERENCES here as content is in a different database
	content_id INTEGER NOT NULL,
	text TEXT NOT NULL
);

-- All searches will be by user_id and maybe content_id, so indexes on those
CREATE INDEX index_note_by_user_id ON note (user_id);
CREATE INDEX index_note_by_user_id_and_content_id ON note (user_id, content_id);

-- Dummy note data
INSERT INTO note
	(user_id, content_id, text)
VALUES
	(1, 95692, 'This seems interesting, but I can''t be bothered to read it.'),
	(1, 95709, 'Now this is something relevant to my interests.'),
	(2, 95692, 'This is a note from the admin user. I hope John doesn''t see it.'),
	(2, 95709, 'Relevant to me as well John, I''m an admin so I can just run SQL on the database directly.');


PRAGMA foreign_keys = ON;
