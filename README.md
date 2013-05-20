Geofier
=======

Create a simple REST GeoService API from alphanumeric databases tables or views and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.

- Do not need Spatial Databases
- Do not need GIS server
- No big changes on your system

### Introduction

**Geofier** is a micro PHP project to serve GeoJSON from DB tables or views with alphanumeric columns 
that represents coordinates.

Tested with PostgreSQL, MySQL and SQLite.

#### When to use 

- There is spatial information in some tables in the DB: 
  - columns like "x_coord" and "y_coord" or 
  - columns like "lat" and "lon"
- You can not install spatial databases due to restrictions of the admins
- Users need to see this information on maps and interact with it.

For these cases, **Geofier is a fantastic solution!**.

#### When not to use

If you have a spatial DB consider other nice project like:
- PHP-Database-GeoJSON: https://github.com/bmcbride/PHP-Database-GeoJSON
- FeatureServer: http://featureserver.org/
- GeoRest: https://code.google.com/p/georest/
- ...

### License

Unless otherwise stated, all code are licensed under the [GPL3 License][].

### Requirements

* PHP >= 5.3.1
* PHP PDO ( http://www.php.net/manual/en/book.pdo.php ): to DB access
* Slim PHP micro framework ( http://www.slimframework.com/ ): to create REST API

### Installation and Usage

You can have it up and working in less than 2 minutes. 
Just download the Geofier project on the web folder to be served, configure and just run.

- Download project (zip, git clone, ...)
- Place it on the web folder (p.e '/var/www/mygeoservice')

After installation, you must changes parameters on 'config.php' file to point your DB:
- database dns
- user/password
- tablename
- id column
- "geo" columns to use to generate the geometry

At this moment, you can access to the GeoJSON from your data and using in on Openlayers or Leaftet.

Test it with URLs like:
- http://localhost/mygeoservice/index.php/features 
- http://localhost/mygeoservice/index.php/feature/1 

Configure the Geojson layers to point the service of the 'test/ol.html' example.

### Geofier API

**Geofier** API has two functions by default:
- GET '/feaures': return all features of the table
- GET '/feature/[id]': return feature/s with that [id]
- GET '/feature/[column]/[value]': return feature/s where "column" equals to "value"

### Extend Geofier API

You can do it easily using Slim framework. Take a look on the index.php to see examples of '$app->get()' and the calls to Database.php functions.
