--#SQLite sondagskooldb
/**
--Command	Description
.show	Displays current settings for various parameters
.databases	Provides database names and files
.quit	Quit sqlite3 program
.tables	Show current tables
.schema	Display schema of table
.header	Display or hide the output table header
.mode Select mode for the output table
.dump	Dump database in SQL text format

--cleanup
DELETE FROM tblename;
VACUUM;
**/

--create new tables
CREATE TABLE orders ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	email TEXT NOT NULL,
	phone TEXT NOT NULL,
	date date NOT NULL,
	active BIT,
	status BIT,
	is_pickup BIT,
	deliveraddress TEXT);

CREATE TABLE admins ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
	name TEXT NOT NULL,
	password TEXT NOT NULL,
    area_id STRING NOT NULL,
	user_level INTEGER NOT NULL);

INSERT INTO admins ('name','password','area_id','user_level') VALUES ('admin', 'beef@pork', 1, 9);

CREATE TABLE access ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	description TEXT NOT NULL);
	/**
    1) agent orders access
    2)
    3)
    4)
    5) product admin - can update pics and prices
    6)
    7)
    8)
    9) Systeam admin - can do all
    **/
INSERT INTO access ('name','description') VALUES ('agent', 'can do orders');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES ('product admin', 'can add & update orders');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES ('system admin', 'can do everything');

CREATE TABLE products ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	description TEXT NOT NULL,
	PricePK TEXT NOT NULL,
	Qtn TEXT NOT NULL,
	Weight TEXT NOT NULL,
	Portion TEXT NOT NULL,
	orders_id INTEGER NOT NULL);