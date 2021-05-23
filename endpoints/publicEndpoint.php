<?php
require_once 'config/database.php';
require_once 'config/dbCredentials.php';
class publicend extends DBASE {


    function __construct()
    {
        parent::__construct();
    }

    public function handleRequest($uri, $requestMethod, $queries, $payload): array
    {
        $res = array();
        // switch used for expandability
        switch ($requestMethod) {
            case RESTConstants::METHOD_GET:
                $res = $this->getProd($queries);
                break;
        }
        return $res;
    }
    public function getProd($queries): array
    {
        $model = $queries['model'] ?? "";
        $sql = "SELECT model, ski_type FROM product WHERE model = :model";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":model", $model);
        $stmt->execute();
        $res = array();
        $count = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $res[$count]["model"] = $row ["model"];
            $res[$count]["ski_type"] = $row ["ski_type"];
            $count = $count + 1;
        }
        if (count($res) == 0) // if nothing is returned, print out a message
        {
            echo "No such products exist";
            return $res;
        }

        return $res;

    }

}