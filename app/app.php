<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug']=true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $DB = new PDO('pgsql:host=localhost;dbname=restaurants');

    $app->get("/", function() use ($app) {
            return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    return $app;



?>
