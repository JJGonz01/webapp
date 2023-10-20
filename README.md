José Jesús González García.
Trabajo de fin de grado 2023.

Debido a que la web no está desplegada, se ha de realizar la siguiente configuración para poder ejecutarla correctamente y que conecte con el reloj.

## INSTALACIÓN DE LA WEB (ESTÁ EN DESARROLLO) SI MÁQUINA VIRTUAL

- **INSTALAR UNA MÁQUINA VIRTUAL O SIMULADOR**
- Instalar Apache2
```
sudo apt install apache2
```
- Instalar php junto a sus dependencias (necesarias para ejecutar el programa)
```
sudo apt install libapache2-mod-php php-common php-xml php-gd php-opcache php-cli php-mbstring php-curl php-mysql php-zip

```
- Instalar composer
```
sudo apt install composer
```
- Instalar LARAVEL
```
composer global require laravel/installer
```
- Instalar MARIADB, para ello seguir los pasos de <a href="https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-ubuntu-20-04-es"> este enlace </a>, realizar los pasos de seguridad y para root cambiar su contraseña a una a la que pueda acceder facilmente a la base de datos, recomiendo 'root' como contraseña.


## **DESCARGAR/ COPIAR EL PROYECTO DE GITHUB**

- En la carpeta del projecto, ejecutar el siguiente comando
```
composer update
```
    
- (Si da error ejecutar el siguiente comando)
    ```
    composer install
    ```

- Una vez hecho eso (composer descargará las dependencias necesarias), generar una clave para el proyecto, para ello use el comando
```
cp .env.example .env
```

```
php artisan key:generate
```
- Ahora el proyecto podrá ejecutarse, para configurar la base de datos, es **necesario** realizar el siguiente proceso

    -  entre en la linea de comandos de mariadb mediante el comando
    ```
    sudo mariadb -uroot -ptucontraseña
    ```
    - genere la base de datos
    ```
    CREATE DATABASE tdahdb;
    ```
    - ejecute el comando
    ```
    php artisan migrate
    ```

- Una vez hecho esto, ya puede lanzar la web
```
php artisan serve
```

## CONEXION CON EL RELOJ

Para que el reloj pueda enviar peticiones, deberá configurar la red de la máquina virtual como "adaptador puente" y ejecutar el comando
```
php artisan serve --host ipdelamaquina
```
Este comando permitirá a cualquier máquina conectada a la red wifi conectarse a la web.
Tendrá que configurar la aplicación desde el proyecto de Android Studio