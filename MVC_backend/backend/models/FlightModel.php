<?php

class FlightModel 
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getFlights()
    {
        $this->db->query("SELECT * FROM flight");
        return $this->db->all();
    }

    public function flightInfo($id)
    {
        $this->db->query("SELECT * FROM flight WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
                flight
            SET
                going_time = :going_time,
                arriving_time = :arriving_time,
                Country_from = :Country_from,
                Country_to = :Country_to,
                CityFrom = :CityFrom,
                CityTo = :CityTo,
                price = :price,
                airport = :airport
            ");
            $this->db->bind(':going_time', $data->going_time);
            $this->db->bind(':arriving_time', $data->arriving_time);
            $this->db->bind(':Country_from', $data->Country_from);
            $this->db->bind(':Country_to', $data->Country_to);
            $this->db->bind(':CityFrom', $data->CityFrom);
            $this->db->bind(':price', $data->price);
            $this->db->bind(':airport', $data->airport);
            $this->db->bind(':CityTo',$data->CityTo);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

}
