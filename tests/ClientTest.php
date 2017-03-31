<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
    protected function tearDown()
     {
     Stylist::deleteAll();
     Client::deleteAll();
     }
     function test_save()
       {
           $tester_stylist = new Stylist("Jenn");
           $tester_stylist->save();
           $stylist_id = $tester_stylist->getId();
           $tester_client = new Client("Jen", $stylist_id);
           $result = $tester_client->save();
           $this->assertTrue($result, "Not saved to database correctly");
       }
      function test_getName()
      {
          //Arrange
          $name = "Joe Smith";
          $test_Client = new Client($name);

          //Act
          $result = $test_Client->getName();

          //Assert
          $this->assertEquals($name, $result);
      }
      function test_deleteAll()
       {
         $stylist = "Jenfer";
           $id = null;
           $new_stylist = new Stylist($stylist, $id);
           $new_stylist->save();
           $client_name = "Xing";
           $stylist_id = $new_stylist->getId();
           $new_client = new Client($client_name, $stylist_id, $id);
           $new_client->save();
           $client_name2 = "Max";
           $stylist_id2 = $new_stylist->getId();
           $new_client2 = new Client($client_name2, $stylist_id2, $id);
           $new_client2->save();
           Client::deleteAll();
           $result = Client::getAll();
           $this->assertEquals([], $result);
       }

    }

?>
