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

    $app->post("/cuisines", function() use ($app) {
        $food_type = new Cuisine($_POST['food_type']);
        $food_type->save();
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app)
    {
        $cuisine= Cuisine::find($id);
        return $app['twig']->render('cuisines.twig', array('cuisine' => $cuisine, 'restaurants'=>$cuisine->getRestaurants()));
    });

    $app->post("/relevant_restaurants", function() use ($app){
        $new_restaurant = $_POST['restaurant'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($id=null, $new_restaurant, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.twig', array('cuisine'=>$cuisine, 'restaurants'=>$cuisine->getRestaurants()));
    });



    return $app;



?>
