.. index::
   single: Configuration

Configuración
=============

La configuración de **Geofier** se realiza modificando el fichero 'app/config.php'.
Este fichero es muy sencillo y está autodocumentado y debe seguir la semántida del 
lenguaje PHP. 

Parámetros básicos
------------------

Se deben configurar los siguientes parámetros para la conexión a la base de datos:

* **DB_TYPE**: tipo de base de datos (pgsql, mysql, sqlite, ...) 
* **DB_HOST**: DNS de la base de datos (la dirección IP, ruta al fichero sqlite, ...)
* **DB_PORT**: puerto de la base de datos que recibe conexiones
* **DB_NAME**: nombre de la base de datos (vacío en sqlite)
* **DB_USER**: usuario de la base de datos
* **DB_PASS**: contraseña del usuario indicado en la base de datos

Se debe configurar también los datos relativos a la tabla y columnas que contienen la
información geográfica:

* **TBL_NAME**: identidicador o nombre de la tabla
* **TBL_ID**: columna que actuará como identificador de cada registro
* **TBL_X**: columna que almacena la coordenada X o Latitud
* **TBL_Y**: columna que almacena la coordenada Y o Longitud


Para poder visualizar correctamente en el mapas los puntos es importante conocer en qué 
sistema de referencia de coordenadas están almacenados. 
**Geofier** ofrece soporte para transformaciones al vuelo entre distintos sistemas de referencia de coordenadas.

Debemos indicar esta información en los parámetros :

* **GEOM_SRS**: código EPSG en el que se encuentran los puntos
* **TO_SRS**: código ESPG en el que queremos visualizar los puntos;

En caso de no querer hacer transformación poner el mismo código EPSG en ambos campos.

NOTA: algunas transformaciones no son posibles o requieren de rejillas de transformación para tener más precisión. 

Parámetros adicionales
----------------------

Se pueden realizar otros pequeños ajustes en el comportamiento de **Geofier**.

Si queremos que en la salida no se muestren ciertas columnas, como por ejemplo 
las columnas con información espacial u otras no relevantes en el mapa, se puede
indicar que no oculten con el parámetro:

* **IGNORE_COLUMNS**: array PHP con los nombres de columnas a ocultar

Si nuestra tabla tiene muchos registros es recomendable acotar el número máximo
de filas que se van a devolver a la salida. Para ello se utiliza al paramátro:

* **MAX_FEAT**: entero que indica el número máximo de elementos en la salida. Poner '-1' en caso de no imponer límite.

