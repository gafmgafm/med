--condition_group_id,condition_id,date_created,date_modified

CREATE TABLE condition_group_member (
    condition_group_id INTEGER NOT NULL,
    condition_id INTEGER NOT NULL,
    date_created VARCHAR DEFAULT (datetime('now')) NOT NULL,
    date_modified VARCHAR DEFAULT (datetime('now')) NOT NULL,
    FOREIGN KEY (condition_group_id) REFERENCES condition_group(id),
    FOREIGN KEY (condition_id) REFERENCES condition(id)
)
;
CREATE INDEX cgm_01_ix ON condition_group_member (condition_group_id)
;
CREATE INDEX cgm_02_ix ON condition_group_member (condition_id)
;
CREATE UNIQUE INDEX cgm_03_ix ON condition_group_member (condition_group_id,condition_id)
;