--id,name,date_created,date_modified

CREATE TABLE condition_type (
    id char(1) PRIMARY KEY,
    name VARCHAR NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL
)
;
CREATE UNIQUE INDEX ct_01_ix ON condition_type (lower(name))