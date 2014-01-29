Geofier
=======

**Geofier** is a small PHP project that provides a simple REST GeoService API on your server. Easy to install and configurate to get GeoJSON layers from a alphanumeric databases tables or views. Suitable for use in OpenLayers, Leaflet or QGis.

- Do not need spatial databases
- Do not need any GIS software
- Do not need big changes on your server

It supports a lots of databases: Postgresql, MySQL, SQLite, Microsoft SQL Server, Sybase, Firebird, etc.

#### When to use 

- There is spatial information in some tables in the DB: 
  - columns like "Xcoord" and "Ycoord", or 
  - columns like "latitude" and "longitude"
- You can not install spatial databases due to restrictions of the admins
- Users need to see this information on maps and interact with it.

For these cases, Geofier is a fantastic solution!. It serves GeoJSON layers from DB tables or views with alphanumeric columns that represents coordinates. 

Visit the web page: http://geofier.com
More info on the documentation: http://geofier.com/docs

### License

Unless otherwise stated, all code are licensed under the [GPL3 License][].

### Requirements

* PHP >= 5.3.1
* PHP PDO ( http://www.php.net/manual/en/book.pdo.php ): to DB access
* Slim PHP micro framework ( http://www.slimframework.com/ ): to create REST API

Depending of your db, you need install php5-pgsql, php5-mysql, php5-sqlite and/or php-oci8. Please, ensure you have properlly installed and working with your web server.

### Installation and Usage

You can have it up and working in less than 2 minutes. 
Just download the Geofier project on the web folder to be served, configure and just run.

- Download project (zip, git clone, ...)
- Place it on the web folder (p.e '/var/www/geofier')

After installation, you must changes parameters on `config.php` file to point your DB:
- database dns
- user/password
- tablename
- id column
- "geo" columns to use to generate the geometry

At this moment, you can access to the GeoJSON from your data and using in on Openlayers or Leaftet.

Test with the following URLs:
- http://localhost/geofier/index.php/configuration

Use it with URLs like:
- http://localhost/geofier/index.php/features 
- http://localhost/geofier/index.php/feature/1 

Configure the GeoJSON layers to point the service of the 'test/ol.html' example.

### Geofier API

**Geofier** API has some default resources:
- GET **'/feaures'**: return all features of the table
- GET **'/feature/[id]'**: return feature/s with that [id]
- GET **'/feature/[column]/[value]'**: return feature/s where "column" equals to "value"

### Extend Geofier API

You can do it easily using Slim framework. Take a look on the index.php to see examples of '$app->get()' and the calls to Database.php functions.

### Others concerns

TODO: Geofier tries to offer JSend-compliant responses on its JSON as described on the web page: http://labs.omniti.com/labs/jsend.


