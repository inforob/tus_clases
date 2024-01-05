#### symfony 6 clase 2 [6 de Enero 2024]

El objetivo de esta clase es familiarizarse con los entornos de desarrollo.
Por un lado utilizaremos por defecto el entorno de desarrollo, esto es **dev** y las 
ventajas de estar en modo desarrollo.
Por otro lado veremos el entorno **prod** y para qué se utiliza.

Veremos también la herramienta **Profiler** para poder depurar y revisar el estado
de nuestra aplicación desde un entorno web.

Por último crearemos un sistema de acceso de usuarios con contraseña.

#### entornos de desarrollo
- entorno dev
- entorno prod


#### crear un formulario de acceso y protección de rutas

```bash
php bin/console make:auth
```

- Configurar security.yaml
- Crear templates admin
- Crear HomeController
- Crear PersonalController

#### configurar máximo numero de intentos de identificación

composer require symfony/rate-limiter

```yaml
    login_throttling:
        max_attempts: 3
```

