INSERT INTO Human (username, fullname, password, email)     
VALUES('spede1', 'Pertti Pasanen', '1$1$gKUeZMLh$m7nafpgoNSgH.aAQrRZ6p1', 'spede@spe.de');

INSERT INTO TaskList (id_owner, name, description) VALUES ('1', 'Koti', 'Ruoka, sisustus ja muu paskartelu');
INSERT INTO TaskList (id_owner, name, description) VALUES ('1', 'Lomamatka', 'Lomareissu Teneriffalle');

INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('1', 'Imuroi',          '2016-10-17 16:00:00',  3, 0);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('1', 'Tiskaa astiat',   '2016-10-16 16:00:00',  2, 0);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('1', 'Vie roskat',      '2016-10-15 16:00:00',  1, 0);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('1', 'Huilaa hetkinen', NULL,                   4, 1);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('1', 'Keksi keksintö',  '2016-10-14 16:00:00',  3, 2);

INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('2', 'Varaa lennot',        '2016-10-26 16:00:00',  3, 2);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('2', 'Varaa hotelli',       '2016-10-25 16:00:00',  2, 1);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('2', 'Varaa vuokra-auto',   '2016-10-24 16:00:00',  1, 0);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('2', 'Lataa offline-kartta',NULL,                   4, 0);
INSERT INTO Task (id_tasklist, name, duedate, priority, status)  VALUES('2', 'Osta matkalaukku',    '2016-10-23 16:00:00',  3, 0);

INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Ostokset',       'shopping-cart',    'primary');
INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Koti',           'home',             'info');
INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Harrastukset',   'heart',            'danger');
INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Mobiili',        'phone',            'success');
INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Matkailu',       'plane',            'warning');
INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Auto',           'road',             'danger');
INSERT INTO Category (id_owner, name, symbol, color) VALUES ('1', 'Ideat',          'cloud',            'info');

INSERT INTO TaskCategory(id_task, id_category) VALUES ('1', '2');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('2', '2');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('3', '2');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('4', '3');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('5', '7');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('6', '5');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('7', '5');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('8', '6');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('9', '4');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('10', '1');
INSERT INTO TaskCategory(id_task, id_category) VALUES ('10', '5');
