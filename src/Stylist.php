<?php

    class Stylist
    {
        private $stylist_name;
        private $id;

        //Constructor
        function __construct($stylist_name, $id = null)
        {
            $this->stylist_name = $stylist_name;
            $this->id = $id;
        }

        //Getters
        function getStylistName()
        {
            return $this->stylist_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getClients()
        {
            $clients = array();
            $return_clients = $GLOBALS['DB']->query("SELECT * FROM client WHERE stylist_id = {$this->getId()};");

            foreach($return_clients as $client) {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $stylist_id, $id);

                array_push($clients, $new_client);
            }
            return $clients;
        }

        //Setters
        function setStylistName($new_stylist)
        {
            $this->stylist_name = (string) $new_stylist;
        }

        //CRUD stuffs, delete/update
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist WHERE id = {$this->getId()};");
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylist (name) VALUES ('{$this->getStylistName()}')");
$this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_stylist)
        {
            $GLOBALS['DB']->exec("UPDATE stylist SET name = '{new_stylist}' WHERE id = {$this->getId()};");
            $this->setStylistName($new_stylist);
        }

        //Static functions listed below
        static function getAll()
        {
        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
        $stylists = array();

        foreach($returned_stylists as $stylist) {
            $name = $stylist['name'];
            $id = $stylist['id'];
            $new_stylist = new Stylist($name, $id);
            array_push($stylists, $new_stylist);
        }

        return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist;");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();

            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();

                if ($stylist_id == $search_id) {
                    $found_stylist = $stylists;
                }

            return $found_stylist;
            }

        }
    }
 ?>
