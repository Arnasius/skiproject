<?php
require_once 'config/database.php';
require_once 'config/dbCredentials.php';
class crep extends DBASE
{

    function __construct()
    {
        parent::__construct();
    }
    public function handleRequest($uri, $requestMethod, $queries, $payload)
    {
    $res = array();

    switch($requestMethod)
    {
        case RESTConstants::METHOD_PUT:
            $res = $this->changeState($uri, $payload);
            break;
        case RESTConstants::METHOD_GET($uri);
            break;
    }

    }
    function verifyOrder($id) //verifying if an order is in the database
    {
        $sql = "SELECT order_id, store_id, franchise_id, team_skier_id, type, quantity, order_state FROM ski_order WHERE order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_NUM);
        if ($row[0] == 0) {
            return false;
        } else {
            return true;
        }

    }

    public function changeState ($uri)
    {
        $res = array();
        $id = $uri[1];

        $verify = $this->verifyOrder($id);

        if ($verify == true) {
            $sql = "UPDATE ski_order SET order_state = 'open' WHERE order_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute;
            echo "Order state has been changed";
            return $res;
        }
        else
            {
                http_response_code((RESTConstants::HTTP_BAD_REQUEST));
                return $res;
            }

    }



}