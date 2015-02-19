[![License](https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png)](http://creativecommons.org/licenses/by-nc-sa/4.0/)

# Truco online opensource

Este es el proyecto de truco online opensource.


Para más información sobre como funciona este proyecto, puedes instalar la aplicacion para smartphone.


Es importante aclarar que este sistema no cuenta con una interfaz gráfica ya que este sistema es una APT RESt que envia respuestas JSON para ser leida por cualquier sistema. Originalmente la aplicación esta desarrollada bajo Appcelerator.

Este sistema se basa en el framework [Laravel], para más información puede visitar su web. Aquí solo se explicarán los comandos necesarios para inicializar esta API.


###Instalación

En la carpeta donde esten bajados los archivos, correr el comando:

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
