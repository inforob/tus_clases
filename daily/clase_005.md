## DoctrineMappings
[https://symfony.com/doc/current/doctrine.html#fetch-automatically]()

Los Doctrine Mapping son maneras o formas de enrutar desde nuestros
controladores a entidades de nuestra base de datos.

Siempre se utilizan como atributos y delante de la entidad. Por ejemplo:

```php
 #[Route('/product/{slug}')]
    public function show(
        #[MapEntity(mapping: ['slug' => 'slug'])]
        Product $product
    ): Response {
        // use the Product!
        // ...
    }
```

Doc: [https://www.youtube.com/watch?v=-Ks0VPqpCU8&feature=youtu.be]()

## TwigExtensions

#### Extensiones definidas por Symfony 
[https://symfony.com/doc/current/reference/twig_reference.html]()

#### Extensiones definidas por el usuario
Son extensiones de código que ayudan a Twig a procesar con funciones y métodos personalizados.
 - Filters
 - Functions


