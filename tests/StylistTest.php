<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        //tearDown put first to ensure database is clear before tests ensue
        protected function tearDown()
        {
            Stylist::deleteAll();
            //Client::deleteAll();
        }

        //Testing save, getAll and deleteAll functions first to ensure it's properly storing and removing information
        function test_save()
        {
            //Arrange
            $name = "Sarah";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Sarah";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Sarah";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        //Moving on to ensure that the data being stored/recalled is being executed properly, testing for id and name fields
        function test_getCuisineName()
        {
            //Arrange
            $name = "Sarah";
            $test_stylist = new Stylist($name);

            //Act
            $result = $test_stylist->getStylistName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Sarah";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        //Adding our two latest function types, the update and delete
        function test_update()
        {
            //Arrange
            $name = "Sarah";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_stylist_name = "Rosetta";

            //Act
            $test_stylist->update($new_stylist_name);

            //Assert
            $this->assertEquals("Rosetta", $test_stylist->getStylistName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Sarah";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Rosetta";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

    }
 ?>
