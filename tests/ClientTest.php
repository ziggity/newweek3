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
         //Arrange
            $name = "Jen";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            // create more than one stlyist
            $description = "Jackson";
            $description2 = "Mike";
            $test_stlyist = new Client($description, $stylist_id);
            $test_stlyist->save();
            $test_stlyist2 = new Client($description2, $stylist_id);
            $test_stlyist2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
       }
       function test_find()
       {
           //Arrange
           $stylst = "Jack";
           $id = null;
           $testerStylist = new Stylist($stylst, $id);
           $testerStylist->save();

           $nameClient = "Max";
           $stylist_id = $testerStylist->getId();
           $new_client = new Client($nameClient, $stylist_id, $id);
           $new_client->save();

           $nameClient2 = "Zak";
           $stylist_id2 = $testerStylist->getId();
           $new_client2 = new Client($nameClient2, $stylist_id2, $id);
           $new_client2->save();
           //Act
           $result = Client::find($new_client->getId());
           //Assert
           $this->assertEquals($new_client, $result);
       }

    }

?>
