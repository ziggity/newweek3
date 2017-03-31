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

function getCategoryId()
{
    return $this->stylist_id;
}

function setName($new_name)
{
    $this->name = (string) $new_name;
}

function setCategoryId($new_stylist_id)
{
    $this->stylist_id = (int) $new_stylist_id;
}

function save()
{
    $executed = $GLOBALS['DB']->exec("INSERT INTO tasks (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()})");
    if ($executed) {
        $this->id = $GLOBALS['DB']->lastInsertId();
        return true;
    } else {
        return false;
    }
}
function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
             if (!$executed) {
                 return false;
             }
             $executed = $GLOBALS['DB']->exec("DELETE FROM tasks WHERE category_id = {$this->getId()};");
             if (!$executed) {
                 return false;
             } else {
                 return true;
             }
        }

}
?>
