
#### symfony 6 clase 1 [2 de Enero 2024]

- Archivos y directorios
- La consola. MakerBundle
- Controladores y rutas
- Usuarios de acceso


## Archivo y directorios de symfony

    - Directorio bin/: Contiene scripts ejecutables, como el archivo console, que se utiliza para ejecutar comandos de consola de Symfony.
    
    - Directorio config/: Contiene archivos de configuración para la aplicación. El archivo config.yml es fundamental y se utiliza para configurar parámetros y servicios.
    
    - Directorio src/: Aquí es donde reside el código fuente de la aplicación. La estructura dentro de src/ generalmente sigue la convención de paquetes de PHP (PSR-4).
    
    - Directorio templates/: Contiene plantillas de vistas escritas en Twig, el motor de plantillas de Symfony.
    
    - Directorio public/: Almacena archivos públicos, como imágenes, hojas de estilo y scripts JavaScript, que se pueden acceder directamente desde la web.
    
    - Directorio var/: Contiene archivos generados automáticamente, como cachés, logs y sesiones de la aplicación.
    
    - Directorio vendor/: Donde se instalan las dependencias de terceros a través de Composer.
    
    - Archivo .env: Configuración del entorno de la aplicación, como la conexión a la base de datos y otras variables de entorno.
    
    - Archivo composer.json: Configuración del proyecto y dependencias gestionadas por Composer.
    
    - Directorio daily : aqui meteremos el guión del temario de cada clase .
    
    - Archivo symfony.lock: Contiene información sobre las versiones exactas de las dependencias de Symfony instaladas.
    
    
## La consola

    - Comandos Symfony: La consola proporciona numerosos comandos Symfony integrados para realizar tareas comunes, como la ejecución de servidores de desarrollo, la generación de controladores y la gestión de la base de datos.
    
    - Ejecución de Comandos: Utilizando el archivo bin/console, puedes ejecutar comandos Symfony desde la línea de comandos. Por ejemplo, php bin/console cache:clear se utiliza para limpiar la caché.
    
    - Creación de Comandos Personalizados: Symfony permite crear comandos personalizados para satisfacer las necesidades específicas de tu aplicación. Estos comandos pueden ejecutarse de manera similar a los comandos Symfony integrados.
    
    - Argumentos y Opciones: Los comandos pueden aceptar argumentos y opciones, permitiéndote personalizar su comportamiento. Estos se definen en el código del comando y se pueden proporcionar al ejecutar el comando.
    
    - Entorno de Consola: Puedes especificar el entorno de la aplicación al ejecutar comandos para controlar la configuración y el comportamiento específicos del entorno (por ejemplo, --env=prod).
    
    - Listado de Comandos: Puedes obtener una lista de todos los comandos disponibles con php bin/console list y obtener información detallada sobre un comando específico con php bin/console help [nombre del comando].
    
    - Interactividad: Algunos comandos pueden ser interactivos, solicitando información al usuario durante su ejecución.
    
    - Eventos de Consola: Symfony dispara eventos de consola que permiten la personalización y extensión del comportamiento de la consola.
    
    
### MakerBundle

Symfony Maker te ayuda a crear comandos, controladores, clases de formularios, pruebas y más vacíos para que puedas olvidarte de escribir código repetitivo. Este paquete supone que estás usando una estructura de directorios estándar de Symfony 5, pero muchos comandos pueden generar código en cualquier aplicación.
    
https://symfony.com/bundles/SymfonyMakerBundle/current/index.html
    
```bash
    composer require --dev symfony/maker-bundle
```
    
```bash
    php bin/console make:command
```


## Controladores y rutas

```bash
    php bin/console make:controller
```
    
Doc : https://symfony.com/doc/current/controller.html


```php

    // devolver respuesta Json
    
    return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TinyController.php',
    ]);
```

```php

    // devolver respuesta Html
    
    return $this->render('path/nombre_plantilla');
```

Doc : https://symfony.com/doc/current/routing.html

- Prefijos de rutas
- Párametros requeridos

## Usuarios de acceso

```bash
    composer require security  
```

```bash
    composer require orm  
```

```bash
    php bin/console doctrine:database:create
```

```bash
    php bin/console make:fixture
```

Link para crear contraseñas seguras : https://bcrypt-generator.com/

```bash
    php bin/console doctrine:fixture:load
```


