-- Need to disable foreign keys while dropping tables, saves having to drop them in the right order
PRAGMA foreign_keys = OFF;

-- Exported from users.sqlite
DROP TABLE IF EXISTS account;
CREATE TABLE IF NOT EXISTS account (
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
CREATE TABLE IF NOT EXISTS note (
	id INTEGER NOT NULL PRIMARY KEY,
	user_id INTEGER NOT NULL REFERENCES account(id),
	-- NOTE: Can't use REFERENCES here as content is in a different database
	content_id INTEGER NOT NULL,
	text TEXT NOT NULL
);

-- Dummy note data
INSERT INTO note
	(user_id, content_id, text)
VALUES
	(1, 95692, 'This seems interesting, but I can''t be bothered to read it.'),
	(1, 95709, 'Now this is something relevant to my interests.'),
	(2, 95692, 'This is a note from the admin user. I hope John doesn''t see it.'),
	(2, 95709, 'Relevant to me as well John, I''m an admin so I can just run SQL on the database directly.');


PRAGMA foreign_keys = ON;
