Geofier
=======

Create a REST GeoService API from non geodb tables or views and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.

### Introduction

**Geofier** is a micro PHP project to serve GeoJSON from DB tables or views with alphanumeric columns 
that represents coordinates.

### When to use 

- There is spatial information in some tables in the DB: 
  - columns like "x_coord" and "y_coord" or 
  - columns like "lat" and "lon"
- You can not install spatial databases due to restrictions of the admins
- Users need to see this information on maps and interact with it.

For these cases, **Geofier is a fantastic solution!**.

### License

Unless otherwise stated, all code are licensed under the [GPL3 License][].

### Requirements

* PHP >= 5.3.1
* PHP PDO ( http://www.php.net/manual/en/book.pdo.php ): to DB access
* Slim PHP micro framework ( http://www.slimframework.com/ ): to create REST API

### Installation

Just download the Geofier project, place to the web folder to serve, configure and run.

Step by step:
- Download project (zip, git clone, ...)
- Place it on the web folder (p.e '/var/www/mygeoservice')

### Usage

After installation, you must changes parameters on 'config.php' file to point your system:
- database (name, dns, ...)
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

### Extend Geofier API

You can do it coding on index.php thanks to Slim.
