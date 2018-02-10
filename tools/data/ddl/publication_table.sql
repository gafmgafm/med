--id,name,publication_type_id,date_created,date_modified

CREATE TABLE publication (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    publication_type_id INTEGER NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL,
    FOREIGN KEY (publication_type_id) REFERENCES publication_type(id)
)
;
CREATE INDEX pub_01_ix ON publication (publication_type_id)