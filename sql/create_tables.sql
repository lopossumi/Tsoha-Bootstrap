CREATE TABLE Human(
    id          SERIAL          PRIMARY KEY,
    username    varchar(20)     NOT NULL, 
    fullname    varchar(100)    NOT NULL,
    password    varchar(255)    NOT NULL,
    email       varchar(254)    NOT NULL,
    isprivate   boolean         DEFAULT TRUE,
    isadmin     boolean         DEFAULT FALSE
);

CREATE TABLE TaskList(
    id          SERIAL          PRIMARY KEY,
    id_owner    INTEGER         REFERENCES Human(id),
    name        varchar(50)     NOT NULL,
    description varchar(200)
);

CREATE TABLE Task(
    id          SERIAL          PRIMARY KEY,
    id_tasklist INTEGER         REFERENCES TaskList(id),
    name        varchar(50)     NOT NULL,
    description varchar(2000),
    duedate     timestamp,
    priority    INTEGER,
    status      INTEGER         DEFAULT 0,
    archived    boolean         DEFAULT FALSE,
    deleted     boolean         DEFAULT FALSE
);

CREATE TABLE Category(
    id          SERIAL          PRIMARY KEY,
    id_owner    INTEGER         REFERENCES Human(id),
    name        varchar(50)     NOT NULL,
    description varchar(200),
    symbol      varchar(50),
    color       varchar(10)
);

CREATE TABLE TaskCategory(
    id_task     INTEGER         REFERENCES Task(id) ON DELETE CASCADE,
    id_category INTEGER         REFERENCES Category(id) ON DELETE CASCADE
);
