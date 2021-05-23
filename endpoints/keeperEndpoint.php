<?php
require_once 'config/database.php';
require_once 'config/dbCredentials.php';
class keeper extends DBASE
{

    function __construct()
    {
        parent::__construct();
    }

    public function handleRequest($uri, $requestMethod, $queries, $payload): array
    {
        $res = array();
        // switch used for expandability
        switch ($requestMethod) {
            case RESTConstants::METHOD_POST:
                $res = $this->createRec($payload);
                break;
        }
        return $res;
    }
    public function createRec($payload): array
    {
        $res = array();
        $this->conn->beginTransaction();
        $sql = "INSERT INTO 
                product (model, ski_type, company_name, temp, grip, size, weight, description, historical, photo_url, msrp)
                VALUES
                (:model, :ski_type, :company_name, :temp, :grip, :size, :weight, :description, :historical, :photo_url, :msrp)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("model", $payload["model"]);
        $stmt->bindParam("ski_type", $payload["ski_type"]);
        $stmt->bindParam("company_name", $payload["company_name"]);
        $stmt->bindParam("temp", $payload["temp"]);
        $stmt->bindParam("grip", $payload["grip"]);
        $stmt->bindParam("size", $payload["size"]);
        $stmt->bindParam("weight", $payload["weight"]);
        $stmt->bindParam("description", $payload["description"]);
        $stmt->bindParam("historical", $payload["historical"]);
        $stmt->bindParam("photo_url", $payload["photo_url"]);
        $stmt->bindParam("msrp", $payload["msrp"]);
        $stmt->execute();
        $this->conn->commit();
        echo "Product has been added";
        return $res;

    }
}
