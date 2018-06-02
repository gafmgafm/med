--id,from_condition_id,to_condition_id,relation_type_id,publication_id,date_created,date_modified

CREATE TABLE condition_relation (
    id INTEGER PRIMARY KEY,
    from_condition_id INTEGER NOT NULL,
    to_condition_id INTEGER NOT NULL,
    relation_type_id CHAR(1) NOT NULL,
    publication_id INTEGER NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL,
    FOREIGN KEY (from_condition_id) REFERENCES condition(id) ON DELETE CASCADE,
    FOREIGN KEY (to_condition_id) REFERENCES condition(id) ON DELETE CASCADE,
    FOREIGN KEY (relation_type_id) REFERENCES relation_type(id) ON DELETE CASCADE,
    FOREIGN KEY (publication_id) REFERENCES publication(id) ON DELETE CASCADE
)
;
CREATE INDEX cr_01_ix ON condition_relation (from_condition_id)
;
CREATE INDEX cr_02_ix ON condition_relation (to_condition_id)
;
CREATE INDEX cr_03_ix ON condition_relation (relation_type_id)
;
CREATE INDEX cr_04_ix ON condition_relation (publication_id)
;
CREATE INDEX cr_05_ix ON condition_relation (from_condition_id, to_condition_id, relation_type_id, publication_id)