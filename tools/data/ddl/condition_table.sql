--id,name,condition_type_id,date_created,date_modified

CREATE TABLE condition (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    condition_type_id CHAR(1) NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL,
    FOREIGN KEY (condition_type_id) REFERENCES condition_type(id)
)
;
CREATE INDEX c_01_ix ON condition (condition_type_id)