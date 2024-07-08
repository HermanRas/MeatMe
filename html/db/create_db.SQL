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

/**
////////////////////////////////////////////////
// ORDERS AND PRODUCTS
////////////////////////////////////////////////
**/
CREATE TABLE orders ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	orderID TEXT NOT NULL,
	name TEXT NOT NULL,
	email TEXT NOT NULL,
	phone TEXT NOT NULL,
	payment BIT  NOT NULL,
	date TEXT NOT NULL,
	active BIT,
	status INTEGER,
	is_pickup BIT,
	area_id INTEGER,
	deliveraddress TEXT,
	totalPrice TEXT);

CREATE TABLE products ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	description TEXT NOT NULL,
	PricePK TEXT NOT NULL,
	Qtn TEXT NOT NULL,
	Weight TEXT NOT NULL,
	Portion TEXT NOT NULL,
	orders_id INTEGER NOT NULL);

/**
////////////////////////////////////////////////
// ADMIN and ACCESS and AREA
////////////////////////////////////////////////
**/
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

INSERT INTO access ('name','description') VALUES ('agent', 'can do orders');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES ('product admin', 'can add & update orders');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES (' ', 'N/A');
INSERT INTO access ('name','description') VALUES ('system admin', 'can do everything');

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

CREATE TABLE area ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	description TEXT NOT NULL);

INSERT INTO area ('name','description') VALUES ('NORTH', 'PTA_NORTH,SKIETFONTEIN,RODEPLAAT,MONTANA');
INSERT INTO area ('name','description') VALUES ('EAST', 'PTA_EAST,CULLINAN,RAYTON,BRONKHORSTSPRUIT');
INSERT INTO area ('name','description') VALUES ('WEST', 'DANVIL,TUINE,GESINA');
INSERT INTO area ('name','description') VALUES ('SOUTH', 'VELERIA,ROOI-HUIS-KRAAL,VALLALA,');
/**
////////////////////////////////////////////////
// STATUS
////////////////////////////////////////////////
**/
CREATE TABLE status ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	description TEXT NOT NULL);

INSERT INTO status ('name','description') VALUES ('NEW', 'New order checking for payment');
INSERT INTO status ('name','description') VALUES ('PAYED', 'Paid ready for processing');
INSERT INTO status ('name','description') VALUES ('PROCESSING', 'Packing Order');
INSERT INTO status ('name','description') VALUES ('READY', 'Ready for Pickup');
INSERT INTO status ('name','description') VALUES ('SHIPED', 'Order Our for delivery');
INSERT INTO status ('name','description') VALUES ('CANCELD', 'CANCELED N/A');
