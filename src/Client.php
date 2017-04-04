<?php
class Client
{
    private $name;
    private $stylist_id;
    private $id;

function __construct($name, $assigned_stylist_id, $id = null)
{
    $this->name = $name;
    $this->stylist_id = $assigned_stylist_id;
    $this->id = $id;
}

function getId()
{
    return $this->id;
}

function getName()
{
    return $this->name;
}

function getStylist_id()
{
    return $this->stylist_id;
}

function setName($new_name)
{
    $this->name = (string) $new_name;
}

function setStylist_id($new_stylist_id)
{
    $this->stylist_id = (int) $new_stylist_id;
}

function save()
{
    $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylist_id()})");
    if ($executed) {
        $this->id = $GLOBALS['DB']->lastInsertId();
        return true;
    } else {
        return false;
    }
}
static function getAll()
       {
           $queryclients = $GLOBALS['DB']->query("SELECT * FROM clients;");
           $clientsArray = array();
           foreach ($queryclients as $client) {
               $name = $client['name'];
               $stylist_id = $client['stylist_id'];
               $id = $client['id'];
               $new_client = new Client($name, $stylist_id, $id);
               array_push($clientsArray, $new_client);
           }
           return $clientsArray;
       }
       static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM clients;");
      }
      static function find($id)
    {
        $finder_client = null;
        $clients = Client::getAll();
        foreach ($clients as $client){
            $client_id = $client->getId();
            if ($client_id == $finderInput){
                $finder_client = $client;
            }
        }
        return $finder_client;
    }

}
?>
