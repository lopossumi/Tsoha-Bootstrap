INSERT INTO Human (username, fullname, password, email) 	
VALUES('spede1', 'Pertti Pasanen', 'spede123', 'spede@spe.de');

INSERT INTO TaskList (id_owner, name, description) VALUES ('1', 'Spedenlista 1', 'Ruoka, sisustus ja muu paskartelu');
INSERT INTO Task (id_tasklist, description, duedate, priority, status) 	VALUES('1',	'Spede Tee se',     '2016-09-22 16:00:00', 	3, 2);
INSERT INTO Task (id_tasklist, description, duedate, priority, status) 	VALUES('1', 'Spede Tee tämä',   '2016-09-23 16:00:00', 	2, 1);
INSERT INTO Task (id_tasklist, description, duedate, priority, status) 	VALUES('1', 'Spede Tee tuo', 	'2016-09-24 16:00:00', 	1, 0);
INSERT INTO Task (id_tasklist, description, duedate, priority, status) 	VALUES('1', 'Spede Leppuuta', 	NULL, 					4, 0);
INSERT INTO Task (id_tasklist, description, duedate, priority, status) 	VALUES('1', 'Spede Tee lisää',  '2016-09-26 16:00:00', 	3, 0);

INSERT INTO TaskList (id_owner, name, description) VALUES ('1', 'Spedenlista 2', 'Speden toisen listan kuvaus');
INSERT INTO Task (id_tasklist, description, duedate, priority, status)  VALUES('2', 'Spede2 Xyzzy',     '2016-09-22 16:00:00',  3, 2);
INSERT INTO Task (id_tasklist, description, duedate, priority, status)  VALUES('2', 'Spede2 Myzzy',     '2016-09-23 16:00:00',  2, 1);
INSERT INTO Task (id_tasklist, description, duedate, priority, status)  VALUES('2', 'Spede2 Pyzzy',     '2016-09-24 16:00:00',  1, 0);
INSERT INTO Task (id_tasklist, description, duedate, priority, status)  VALUES('2', 'Spede2 Jazza',     NULL,                   4, 0);
INSERT INTO Task (id_tasklist, description, duedate, priority, status)  VALUES('2', 'Spede2 Rozzo',     '2016-09-26 16:00:00',  3, 0);

INSERT INTO Category (id_owner, description, symbol)    VALUES ('1', 'Spedenkategoria sydän',   'heart');
INSERT INTO Category (id_owner, description, symbol)    VALUES ('1', 'Spedenkategoria pencil',  'pencil');

INSERT INTO TaskCategory(id_task, id_category)          VALUES ('1', '1');
INSERT INTO TaskCategory(id_task, id_category)          VALUES ('1', '2');
INSERT INTO TaskCategory(id_task, id_category)          VALUES ('2', '1');
INSERT INTO TaskCategory(id_task, id_category)          VALUES ('3', '2');
INSERT INTO TaskCategory(id_task, id_category)          VALUES ('6', '1');
INSERT INTO TaskCategory(id_task, id_category)          VALUES ('6', '2');
