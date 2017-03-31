<?php
class Stylist
{
    private $name;
    private $id;
          function __construct($name, $id = null)
          {
              $this->name = $name;
              $this->id = $id;
          }

          function setName($new_name)
          {
              $this->name = (string) $new_name;
          }

          function getName()
          {
              return $this->name;
          }

          function getId()
          {
              return $this->id;
          }

          function save()
          {

              $executed = $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}')");
              if ($executed) {
                   $this->id= $GLOBALS['DB']->lastInsertId();
                   return true;
              } else {
                   return false;
              }
          }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $id = $task['id'];
            $category_id = $task['category_id'];
            $new_task = new Task($description, $category_id, $id);
            array_push($tasks, $new_task);
        }
        return $tasks;
      }



    }
?>
