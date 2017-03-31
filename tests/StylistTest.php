<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase {



    function test_getId()
        {
            //Arrange
            $name = "Jack";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $description = "Mike";
            $stylist_id = $test_stylist->getId();
            $test_style = new Stylist($description, $stylist_id);
            $test_style->save();

            //Act
            $result = $test_style->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
          }
          function test_deleteAll()
            {
                //Arrange
                $name = "Jenfer";
                $name2 = "Luka";
                $test_stylist = new stylist($name);
                $test_stylist->save();
                $test_stylist2 = new stylist($name2);
                $test_stylist2->save();

                //Act
                stylist::deleteAll();
                $result = stylist::getAll();

                //Assert
                $this->assertEquals([], $result);
            }
            function test_find()
        {
            //Arrange
            $stylist = "Jacky";
            $stylist2 = "Nick";
            $testerStylist = new Stylist($stylist);
            $testerStylist->save();
            $testerStylist2 = new Stylist($stylist2);
            $testerStylist2->save();

            //Act
            $result = Stylist::find($testerStylist->getId());

            //Assert
            $this->assertEquals($testerStylist, $result);
        }

  }
?>
