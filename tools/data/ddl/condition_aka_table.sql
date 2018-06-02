--id,name,is_simple,condition_id,date_created,date_modified

CREATE TABLE condition_aka (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    is_simple CHAR(1) NOT NULL CHECK (is_simple = 'Y' OR is_simple='N'),
    condition_id INTEGER NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL,
    FOREIGN KEY (condition_id) REFERENCES condition(id) ON DELETE CASCADE
)
;
CREATE INDEX caka_01_ix ON condition_aka (condition_id)
;
CREATE INDEX caka_02_ix ON condition_aka (lower(name))