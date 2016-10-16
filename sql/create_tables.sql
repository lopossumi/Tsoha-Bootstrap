CREATE TABLE human(
    id          SERIAL          PRIMARY KEY,
    username    varchar(20)     NOT NULL, 
    fullname    varchar(100)    NOT NULL,
    password    varchar(255)    NOT NULL,
    email       varchar(254)    NOT NULL,
    isprivate   boolean         DEFAULT TRUE,
    isadmin     boolean         DEFAULT FALSE
);

CREATE TABLE tasklist(
    id          SERIAL          PRIMARY KEY,
    id_owner    INTEGER         REFERENCES human(id) ON DELETE CASCADE,
    name        varchar(50)     NOT NULL,
    description varchar(200)
);

CREATE TABLE task(
    id          SERIAL          PRIMARY KEY,
    id_tasklist INTEGER         REFERENCES tasklist(id) ON DELETE CASCADE,
    name        varchar(50)     NOT NULL,
    description varchar(2000),
    duedate     timestamp,
    completed   timestamp,
    priority    INTEGER,
    repeat      INTEGER,
    status      INTEGER         DEFAULT 0,
    archived    boolean         DEFAULT FALSE,
    deleted     boolean         DEFAULT FALSE
);

CREATE TABLE category(
    id          SERIAL          PRIMARY KEY,
    id_owner    INTEGER         REFERENCES human(id),
    name        varchar(50)     NOT NULL,
    description varchar(200),
    symbol      varchar(20),
    color       varchar(20)
);

CREATE TABLE taskcategory(
    id_task     INTEGER         REFERENCES task(id) ON DELETE CASCADE,
    id_category INTEGER         REFERENCES category(id) ON DELETE CASCADE
);
