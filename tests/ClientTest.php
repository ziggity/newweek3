<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
  {

      // protected function tearDown()
      // {
      //     Client::deleteAll();
      //     Stylist::deleteAll();
      // }

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
    }

?>
