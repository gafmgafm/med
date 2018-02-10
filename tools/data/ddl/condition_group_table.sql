--id,name,parent_condition_group_id,date_created,date_modified

CREATE TABLE condition_group (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    parent_condition_group_id INTEGER,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL,
    FOREIGN KEY (parent_condition_group_id) REFERENCES condition_group(id)
)
;
CREATE INDEX cg_01_ix ON condition_group (parent_condition_group_id)