Instalación
===========

Puedes tener **Geofier** instalado y funcionando en menos de 5 minutos. Sólamente descarga el software 
en el directorio del servidor web, configura un par de parámetros y listo.

Descarga
--------

Puedes encontrar enlaces para obtener la última versión de **Geofier** en:

* la página web del proyecto
* en el repositorio de github


Requisitos
----------

**Geofier** es un proyecto en PHP para servidor por lo que necesitarás:

* PHP >= 5.3.1
* PHP PDO ( http://www.php.net/manual/en/book.pdo.php ) 
* PHP PDO para la base de datos con la que quieras trabajar (p.e php5-mysql)
* Un servidor web (por ejemplo Apache Server) configurado adecuadamente


Preconfiguración
----------------

Antes de poder trabajar con **Geofier** deberías comprobar que el servidor web tiene habilitado PHP 
con el módulo PDO específico para la base de datos con la que se va a trabajar. Normalmente puedes consultarlo
creando una página <?php phpinfo()  ?>.

Si necesitas ayuda en este paso, por favor, consulta documentación específica para tu sistema operativo y
servidor de mapas.


Instalación
------------

Una vez obtenido el software y tu sistema cumpliento los requisitos indicados, sólo tienes que poner la carpeta
**geofier** en la ruta donde la servirá tu servidor web.

Por ejemplo, normalmente en Apache server sobre Ubuntu será en "/var/www/geofier"






