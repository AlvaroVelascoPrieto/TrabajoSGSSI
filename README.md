## DOCS
Documentacion [aqui](https://github.com/AlvaroVelascoPrieto/TrabajoSGSSI/blob/master/Sistema%20de%20Gesti%C3%B3n%20de%20Seguridad%20de%20Sistema%20de%20Informaci%C3%B3n.pdf)
## Trabajo SGSSI
Linux + Apache + MariaDB (MySQL) + PHP 7.2 on Docker Compose. Mod_rewrite enabled by default.

Alvaro Velasco Prieto
Alberto Aróstegui García
David Elorza Gabilondo

## Requisitos

La pagina web ha de ser abierta mediante Google Chrome.
Si no dispone de ello, para instalarlo emplearemos los siguientes comandos:
Primero actualizamos el sistema:
```bash
$ sudo apt-get update
```

Descargamos el paquete para la instalación de chrome:
```bash
$ wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
```

Instalamos el paquete:
```bash
$ sudo apt install ./google-chrome-stable_current_amd64.deb
```


Para hacer el despliegue de la página usaremos Docker, si no dispone de docker en su sistema instalelo mediante los siguientes comandos:
Primero actualizamos el sistema:
```bash
$ sudo apt-get update
```
E instalamos docker:
```bash
$ sudo apt-get install docker-ce docker-ce-cli containerd.io
```
Además, instalamos docker-compose:
```bash
$ sudo apt install docker-compose
```

## Instrucciones de uso

Para obtener los archivos del directorio del proyecto se ha de emplear el siguiente comando:
```bash
$git clone https://github.com/AlbertoArostegui/TrabajoSGSSI
```

Una vez obtenidos los archivos del repositorio, accedemos a la carpeta y construimos la imagen web mediante el siguiente comando:
```bash
$ docker build -t=”web” .
```

Tras esto, desplegamos los servicios mediante:
```bash
$ docker-compose up
```

Una vez hecho esto la página web estará corriendo en el puerto 81.
No obstante para conseguir toda la funcionalidad debemos restaurar la base de datos. Para ello nos dirigiremos al [puerto 8890](http://localhost:8890/).
Una vez alli, para acceder utiliza el nombre de usuario "admin" y la contraseña "test".
Una vez dentro, haz click en “database” y luego en “import”, elige el archivo database.sql, finalmente haz click en "Import".
