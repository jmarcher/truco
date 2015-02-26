[![License](https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png)](http://creativecommons.org/licenses/by-nc-sa/4.0/)

# Truco online

Este es el proyecto de truco online.


Para más información sobre como funciona este proyecto, puedes instalar la aplicacion para smartphone.


Es importante aclarar que este sistema no cuenta con una interfaz gráfica ya que este sistema es una APT RESt que envia respuestas JSON para ser leida por cualquier sistema. Originalmente la aplicación esta desarrollada bajo Appcelerator.

Este sistema se basa en el framework [Laravel], para más información puede visitar su web. Aquí solo se explicarán los comandos necesarios para inicializar esta API.


###Instalación

Es necesario tener instalado [composer] para poder bajar las dependencias de la aplicación, una vez que se tiene [composer], ejecutar el siguiente comando:

```sh
$ composer update
```

Este comando bajará todos los archivos que se necesitan automáticamente.

En la carpeta donde estén bajados los archivos, correr el comando:

```sh
$ php artisan migrate
```

Con este comando se crearán las estructuras de la base de datos.
Ahora tenemos que cargar los datos necesarios en la base:
```sh
$ php artisan db:seed
```
Listo, ahora si queremos probar la API, se puede correr el servidor de prueba:

```sh
$ php artisan serve
```




[Laravel]:http://laravel.com
[composer]:http://getcomposer.org
