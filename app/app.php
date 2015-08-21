<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    //Absolutely losing my mind here. receive error "Fatal error: Call to a member function getClients() on a non-object in /Users/danasharman/Desktop/hair_salon/app/app.php on line 31" after clicking on a stylist to view clients. All tests passed for my methods, so I'm guessing the issue has to be with my routing. I carefully went over all of this, for a serious six hours working on this one little issue, and could not resolve it. All the other code in this app was written in the first two hours, but I cannot get past this. From what I understand, in the below $app->get command I am setting $stylist to equal a new instance of the class stylist, and calling the method within for find($id). from there, we compare in our array the id's in $stylist (aka the Stylist::find($id)) to the results of getClients. The getClients method found within the Stylist.php file then creates an empty array for displaying the information, and searches the database table 'client' for the information stylist_id, id, and name. it then displays this information within the array, and pushes it back this this get function. So How the heck can my code pass tests yet still have a method calling on a non-object? every piece of this code stacks up to my previous work, work ive found from others online, this section at least, and its moving parts (counting the get call here, the stylist.html.twig page, the test and the class method for getClients have all been reviewed exhaustively, and not only make sense, but also match other working code i have, to the T). I'm out of ideas. Throw me a bone please!!!!
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);

        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST['stylist_name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/clients", function() use ($app) {
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($name, $stylist_id, $id = null);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('delete_clients.html.twig');
    });

    $app->post("delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('delete_stylists.html.twig');
    });
    return $app;
 ?>
