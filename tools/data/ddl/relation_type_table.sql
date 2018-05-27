--id,name,date_created,date_modified

CREATE TABLE relation_type (
    id CHAR(1) PRIMARY KEY,
    name VARCHAR UNIQUE NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL
)