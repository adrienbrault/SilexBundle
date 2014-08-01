SilexBundle
===========

Integrate Silex into symfony2 full stack (with the exception of pimple/service providers, but we have bundles instead
:D).

Motivation
----------

My experience of silex is that it's very quick to write a few controllers, and have a website working.
However I always end up missing the configuration layer of symfony full stack. I also quickly start to miss
the popular symfony bundles.

The idea here is to define your controllers like in a silex application (*fast prototyping*), while keeping the
full stack advantages.

For example, you could write an api with the silex api while still being able to leverage the FOSRestBundle features.

Installation
------------

- Require `adrienbrault/SilexBundle 0.1.*@dev`
- Add `AdrienBrault\SilexBundle\SilexBundle` to your AppKernel
- Add the following to your `routing.yml`:
```yaml
silex:
    resource: .
    type: silex
```
- Configure the bundle to use your "silex files":
```yaml
silex:
    files:
        - "%kernel.root_dir%/../src/controllers.php"
```
- Profit:
```php
<?php

// src/controllers.php

$app->get('/', function () {
    return 'Hello!';
});

$app->get('/wow/{name}', function ($name) use ($app) {
    return $app['twig']->render('wow.html.twig', array(
        'name' => $name,
    ));
});
```
