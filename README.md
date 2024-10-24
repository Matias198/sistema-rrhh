# SISTEMA DE RECURSOS HUMANOS

## Lista de requerimientos

1.  PHP ^8.2.5 (<a>https://www.php.net</a>)
2.  PostgreSQL ^15.3 (<a>https://www.postgresql.org</a>)
3.  Composer ^2.5.5 (<a>https://getcomposer.org</a>)
4.  Node.js ^20.15.0 (<a>https://nodejs.org</a>)
5.  Vite ^5.4.8 (<a>https://es.vitejs.dev</a>)

## Configurando el entorno

1.  Cree una base de datos (DB) Postgres en su sistema
2.  Establezca un nombre, el usuario "OWNER" y una contraseña para la base de datos.
3.  Cree un archivo ".env" con el archivo ".env.example" de base
4.  Modifique la configuracion en su archivo .env en los apartados:

```
DB_CONNECTION=pgsql (pgsql por defecto para Postgres)
DB_HOST=127.0.0.1 (Host por defecto de la DB 127.0.0.1)
DB_PORT=5432 (Puerto Postgre por defecto de la DB 5432)
DB_DATABASE=**** (Nombre de la DB)
DB_USERNAME=**** (Nombre del usuario "OWNER" de la DB)
DB_PASSWORD=**** (Contraseña de la DB)
```
    
5.  Abra un un terminal (CLI) con dirección dentro del proyecto y ejecute el comando: 

```
php artisan migrate:fresh --seed
```

Si la operación es exitosa, su base de datos está lista, de lo contrario verifique que PostgreSQL se esté ejecutando en su sistema y la configuración esté correctamente establecida en el archivo ".env" para la base de datos creada en su sistema.

## Instalando dependencias

Para operar de forma correcta necesita instalar las dependencias del sistema. Para ello siga los pasos a continuación:

1.  Se deben instalar las dependencias de Laravel, para ello debe ejecutar en el mismo terminal el comando:

```
composer install
```

2.  Luego de finalizar la instalación de dependencias de Laravel, se procede a instalar las dependencias de Node. Para ello debe ejecutar en el mismo terminal el comando: 

```
npm install
```

## Iniciando el sistema
Para iniciar el sistema se requieren de dos terminales con direccion dentro del proyecto para ejecutar los siguientes comandos:

1.  El primer comando a ejecutar en el primer terminal es: 

```
npm run dev
```

2.  El segundo comando a ejecutar en el segundo terminal es: 
  
```
php artisan serve
```

Si la operación es exitosa podrá ver en el terminal la dirección en la cual se aloja la aplicación web, por defecto es <a>http://127.0.0.1:8000</a> (localhost). Compruebe esta información en su terminal.

## Iniciando Sesión
Para iniciar sesión con el usuario por defecto (administrador) ingrese las siguientes credenciales:
1.  Correo: 

```
matias@mail.com
```

2.  Contraseña:

```
12345678
```

En este punto el sistema ya es completamente funcional. Con esta cuenta de administrador podrá cargar a los usuarios finales del sistema con los roles deseados.

## Sistema de Mail
Para poder utilizar las opciones de Mail debe configurar los siguientes parametros del archivo .env
```
MAIL_MAILER=smtp (Servicio de email, por defecto SMTP)
MAIL_HOST= (Host de su proveedor de servicios email)
MAIL_PORT=2525 (Puerto SMTP)
MAIL_USERNAME=**** (Nombre de usuario de su proveedor de servicios email)
MAIL_PASSWORD=**** (Contraseña de su proveedor de servicios email)
MAIL_ENCRYPTION=null (Tipo de encriptado)
MAIL_FROM_ADDRESS="no-reply@rrhh.com" (Mascara de dirección email)
MAIL_FROM_NAME="${APP_NAME}" (Nombre de remitente, por defecto ${APP_NAME})
```