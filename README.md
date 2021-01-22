# apachePhpRestEx

Overview:
------------------------------------------------------------------------------------------------------------------
This code is meant to be an example of creating a REST interface with Apache Webserver, PHP, and MySql.
The example using a basic "store" website to realize this goal. 

REST Interface:
/ecommerce/product                Retrieves all products
/ecommerce/product/(id)           Retrieve a product using ID
/ecommerce/category/IT            Retrieves all products in IT
/ecommerce/category/Coding        Retrieves all products in Coding

Web Addresses
/ecommerce/coding/                Pulls up the store with Coding Services
/ecommerce/IT/                    Pulls up the store with IT services

Requirement:
------------------------------------------------------------------------------------------------------------------
To use this code MySql, Apache2, and PHP 7 must be installed and setup in order to use this code.

MySql:
For MySql the code uses a database named test_db. The main table in there is the product table. 
Product table layout:
NAME                      TYPE            NULL                AUTO-INCREMENT
id                         int             No                       Yes
name                    varchar(100)       No                       No
short_description       varchar(100)       No                       No
description             varchar(256)       No                       No
price                     double           No                       No
rating                    double           No                       No
num_in_stock                int            No                       No
cat                         int            No                       No
pic_location            varchar(256)       No                       No

There is an example database included in the config/test_db.sql. This will create the products table
and fill in some example data.

pic_location is a reference to the table which holds the picture locations for this product entry.
For every product entry a (id)_img table is created to hold the locations for every picture that goes
with that product. Then the name of the new image table is placed back into the product table's entry. 

Currently the code assumes two users for the MySql named webuser and webroot. The webroot user is an 
admin for the test_db database. The webuser account is for the public REST interface. Of course, this
can be altered in the code to be only one user. 

Apache:
For apache web server, PHP and mod_rewrite must be enabled before any of this code can be run.

Code:
------------------------------------------------------------------------------------------------------------------

Directory:

config:
Config directory has the apache configs and the test_db.sql

src:
Src directory has the source files. There are two different directories of source files. The webroot directory
has the code for the test site. The admin directory has code for a test admin site that just allows the user to
add products into the databse. 

In the source directories there are api directories which house the PHP code. 

config             Directory holds the information for connecting to the MySql Data.
objects            Direcotry holds the classes used to abstract the sql queries.


