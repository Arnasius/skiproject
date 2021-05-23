<?php
require_once 'config/database.php';
require_once 'config/dbCredentials.php';
    class customer extends DBASE{

        // Connection
//        private $conn;

        // Db connection
//        public function __construct($db)
//        {
//            $this->conn = $db;
//        }
        //Initializing connection
        function __construct()
        {
            parent::__construct();
        }

        // Handle request
        public function handleRequest($uri, $requestMethod, $queries, $payload): array
        {
            $res = array();
            switch ($requestMethod)
            {
                case RESTConstants::METHOD_GET:
                    $res = $this->getPlan();
                    break;
                case RESTConstants::METHOD_DELETE:
                    $res = $this->deleteOrder($uri);
            }
            return $res;
        }
        function defaultPlan() // my idea of default plan is the latest plan.
        {
            $sql = "SELECT prod_plan_id FROM production_plan ORDER BY prod_plan_id DESC LIMIT 1";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchColumn();
        }
        // GET production plan
        public function getPlan(): array
        {
            $currentPlan = $this->defaultPlan();
            $sql = "SELECT prod_plan_id, start_date, end_date, company_name, ski_quantity, ski_type_quantity FROM production_plan WHERE prod_plan_id = '$currentPlan'";
            // $stmt = $this->conn->prepare($sql);
            // $stmt->execute();
            // return $stmt;
            // first incomplete idea of fetching data
            $res = array();

            $count = 0;
            $stmt = $this->conn->query($sql);
            while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
            {
                $res[$count]["prod_plan_id"] = $row ["prod_plan_id"];
                $res[$count]["start_date"] = $row ["start_date"];
                $res[$count]["end_date"] = $row ["end_date"];
                $res[$count]["company_name"] = $row ["company_name"];
                $res[$count]["ski_quantity"] = $row ["ski_quantity"];
                $res[$count]["ski_type_quantity"] = $row ["ski_type_quantity"];
                $count= $count + 1;
            }
            return $res;

        }
        // checking if an ID exists
        function verifyOrder($id): bool
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



        // Delete an order
        Public function deleteOrder($uri): array
        {
            $id = $uri[1];
            $res = array();


            $verify = $this->verifyOrder($id);

            if ($verify == true) {
                $sql = "DELETE FROM ski_order WHERE order_id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();

                echo "Order deleted";
                return $res;
            } else
                // error handling in regards to the ID issues
                {
                http_response_code(RESTConstants::HTTP_BAD_REQUEST);
                echo "Error: Order number does not exist";
                return $res;
            }

        }



    }