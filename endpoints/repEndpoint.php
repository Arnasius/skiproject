<?php
require_once 'config/database.php';
require_once 'config/dbCredentials.php';
class crep extends DBASE
{
    //initializing connection
    function __construct()
    {
        parent::__construct();
    }
    //handling the request
    public function handleRequest($uri, $requestMethod, $queries, $payload): array
    {
    $res = array();
    // different method selection
    switch($requestMethod)
    {
        case RESTConstants::METHOD_PUT:
            $res = $this->changeState($uri);
            break;
        case RESTConstants::METHOD_GET:
            $res = $this->retrieveOrder($queries);
            break;
    }
    return $res;
    }
    function verifyOrder($id): bool //verifying if an order is in the database
    {
        $sql = "SELECT order_id, store_id, franchise_id, team_skier_id, type, quantity, order_state FROM ski_order WHERE order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_NUM); // handling errors if the state is not "new"
        if ($row[0] == 0) {
            echo "Order does not exist";
            return false;
        } else {

            return true;
        }

    }
    //a function for changing the state from "new" to "open"
    public function changeState ($uri): array
    {
        $res = array();
        $id = $uri[1];

        $verify = $this->verifyOrder($id);

        if ($verify == true) {
            $sql = "UPDATE ski_order SET order_state = 'open' WHERE order_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            echo "Order state has been changed";
            return $res;
        }
        else
            {
                http_response_code((RESTConstants::HTTP_BAD_REQUEST));
                return $res;
            }

    }
    // GET implementation for retrieving all orders based on their status.
    public function retrieveOrder($queries): array
    {
        $status = $queries['status'] ?? '';
        //in the expectations, it was only required to let the customer rep view only new orders, however it makes more sense to check the
        //other type of order states too, for flexibility in regards to problems.
        $sql = "SELECT order_id, store_id, franchise_id, team_skier_id, type, quantity, order_state FROM ski_order WHERE order_state = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":status", $status);
        $stmt->execute();
        $res = array();
        $count = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $res[$count]["order_id"] = $row ["order_id"];
            $res[$count]["store_id"] = $row ["store_id"];
            $res[$count]["franchise_id"] = $row ["franchise_id"];
            $res[$count]["team_skier_id"] = $row ["team_skier_id"];
            $res[$count]["type"] = $row ["type"];
            $res[$count]["quantity"] = $row ["quantity"];
            $res[$count]["order_state"] = $row ["order_state"];
            $count = $count + 1;
        }
        if (count($res) == 0) // if nothing is returned, print out a message, error handling for non existing orders.
        {
            echo "No such orders exist";
            return $res;
        }
        return $res;
    }


}