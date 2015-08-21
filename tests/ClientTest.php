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

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_getId()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();

                //Act
                $result = $test_client->getId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

            function test_getCategoryId()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();

                //Act
                $result = $test_client->getStylistId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

            function test_save()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);

                //Act
                $test_client->save();

                //Assert
                $result = Client::getAll();
                $this->assertEquals($test_client, $result[0]);
            }

            function test_getAll()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();

                $client2 = "Prentis Mortimer Ramsbottom IX";
                $address2 = "123 Belmont";
                $phone2 = "123-456-7890";
                $stylist_id2 = $test_Stylist->getId();
                $test_client2 = new Client($client, $cuisine_id, $id);
                $test_client2->save();

                //Act
                $result = Client::getAll();

                //Assert
                $this->assertEquals([$test_client, $test_client2], $result);

            }

            function test_deleteAll()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();

                $client2 = "Prentis Mortimer Ramsbottom IX";
                $stylist_id2 = $test_Stylist->getId();
                $test_client2 = new Client($client, $cuisine_id, $id);
                $test_client2->save();

                //Act
                Client::deleteAll();

                //Assert
                $result = Client::getAll();
                $this->assertEquals([], $result);
            }

            function test_find()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();

                $client2 = "Prentis Mortimer Ramsbottom IX";
                $stylist_id2 = $test_Stylist->getId();
                $test_client2 = new Client($client, $cuisine_id, $id);
                $test_client2->save();

                //Act
                $result = Client::find($test_client->getId());

                //Assert
                $this->assertEquals($test_client, $result);
            }

            function test_update()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();


                $new_client_name = "Prentis Mortimer Ramsbottom IX";

                //Act
                $test_client->update($new_client_name);

                //Assert
                $this->assertEquals("Prentis Mortimer Ramsbottom IX", $test_client->getName());
            }

            function testDelete()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Stylist = new Stylist($name, $id);
                $test_Stylist->save();

                $client = "Cecil Bertram Beaversnatch, Esq.";
                $cuisine_id = $test_Stylist->getId();
                $test_client = new Client($client, $cuisine_id, $id);
                $test_client->save();

                $client2 = "Prentis Mortimer Ramsbottom IX";
                $stylist_id2 = $test_Stylist->getId();
                $test_client2 = new Client($client, $cuisine_id, $id);
                $test_client2->save();

                //Act
                $test_client->delete();

                //Assert
                $this->assertEquals([$test_client2], Client::getAll());
            }
    }
 ?>
