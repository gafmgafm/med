--id,name,date_created,date_modified

CREATE TABLE publication_type (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL
)
;
CREATE UNIQUE INDEX pt_01_ix ON publication_type (name)