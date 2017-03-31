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
    $executed = $GLOBALS['DB']->exec("INSERT INTO tasks (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylist_id()})");
    if ($executed) {
        $this->id = $GLOBALS['DB']->lastInsertId();
        return true;
    } else {
        return false;
    }
}
static function getAll()
       {
           $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
           $clients = array();
           foreach ($queryclients as $client) {
               $name = $client['name'];
               $stylist_id = $client['stylist_id'];
               $id = $client['id'];
               $new_client = new Client($name, $stylist_id, $id);
               array_push($clients, $new_client);
           }
           return $clients;
       }
// function delete()
//         {
//             $executed = $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
//              if (!$executed) {
//                  return false;
//              }
//              $executed = $GLOBALS['DB']->exec("DELETE FROM tasks WHERE category_id = {$this->getId()};");
//              if (!$executed) {
//                  return false;
//              } else {
//                  return true;
//              }
//         }

}
?>
