<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";


    //Start Silex app
    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=restaurant_projects';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    //Twig Paths
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    // Get Calls
    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });
