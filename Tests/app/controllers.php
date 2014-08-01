<?php

$app->get('/', function () {
    return 'Hello!';
});

$app->get('/wow/{name}', function ($name) use ($app) {
    return $app['twig']->render('wow.html.twig', array(
        'name' => $name,
    ));
});
