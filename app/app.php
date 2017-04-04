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
      return $app['twig']->render('index.html.twig', array('stylists'=> Stylist::getAll()));
    });
    $app->post("/stylists", function() use ($app) {
      $stylist = new Stylist($_POST['name']);
      $stylist->save();
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->get("/clients", function() use ($app) {
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });
    $app->post('/delete_stylists', function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app['twig']->render('index.html.twig');
    });
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist));
    });
    $app->post("/client", function() use ($app) {
        $client = new Client($_POST['name'], $_POST['stylist_id']);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });
    $app->get("/seeall", function() use ($app){
        $stylist = Stylist::getAll();
        //$client = Client::getAll();
        return $app['twig']->render('seeall.html.twig', array('stylists'=> $stylist, 'clients' => $client));
    });
    $app->delete("/stylists_edit/{id}", function($id) use ($app) {
      $stylist = Stylist::find($id);
      $stylist->delete();
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });


    return $app;
?>
