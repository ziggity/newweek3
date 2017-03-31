<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

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

    $app->get("/", function() use ($app) {
      return $app['twig']->render('index.html.twig');
    });

    // $app->get("/clients", function() use ($app) {
    //     return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    // });

//     $app->post("/clients", function() use ($app) {
//         $description = $_POST['description'];
//         $client_id = $_POST['client_id'];
//         $task = new Client($description, $id = null, $client_id);
//         $task->save();
//         $client = Stylist::find($client_id);
//         return $app['twig']->render('client.html.twig', array('client' => $client, 'clients' => $client->getClients()));
//     });
//
//     $app->get("/stylists", function() use ($app) {
//         return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
//     });
//
//     $app->post("/stylists", function() use ($app) {
//         $client = new Stylist($_POST['name']);
//         $client->save();
//         return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
//     });
//
//     $app->get("/stylists/{id}/edit", function($id) use ($app) {
//     $client = Stylist::find($id);
//     return $app['twig']->render('client_edit.html.twig', array('client' => $client));
//     });
//
//     $app->patch("/stylists/{id}", function($id) use ($app) {
//     $name = $_POST['name'];
//     $client = Stylist::find($id);
//     $client->update($name);
//     return $app['twig']->render('client.html.twig', array('client' => $client, 'clients' => $client->getClients()));
// });
//
//     $app->get("/stylists/{id}", function($id) use ($app) {
//     $client = Stylist::find($id);
//     return $app['twig']->render('client.html.twig', array('client' => $client, 'clients' => $client->getClients()));
//     });
//
//     $app->delete("/stylists/{id}", function($id) use ($app) {
//     $client = Stylist::find($id);
//     $client->delete();
//     return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
//     });
//
//     $app->post("/delete_stylists", function() use ($app) {
//         Stylist::deleteAll();
//         return $app['twig']->render('index.html.twig');
//     });
//
//     $app->post("/delete_clients", function() use ($app) {
//         Client::deleteAll();
//         return $app['twig']->render('index.html.twig');
//     });


    return $app;
?>
