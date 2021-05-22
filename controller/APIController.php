<?php
require_once 'RESTConstants.php';
require_once 'config/database.php';
require_once 'endpoints/customerEndpoint.php';
class APIController
{

    public function isValidEndpoint($uri)
    {
        switch ($uri[0]) {
            case RESTConstants::ENDPOINT_CUSTOMER:
                if (count($uri) == 1) {
                    return true;
                } else if (count($uri) == 2) {
                    return ctype_digit($uri[1]);//check if an input is a digit
                }
        }
        return false;
    }




    public function isValidMethod(array $uri, string $requestMethod)
    {
        switch ($uri[0])
        {
            case RESTConstants::ENDPOINT_CUSTOMER:
                if (count($uri) == 1 && $requestMethod == RESTConstants::METHOD_GET) return true;

                return false;
        }
    }

    public function handleRequest($uri, $requestMethod, $queries, $payload)
    {
        switch($uri[0])
        {
            case RESTConstants::ENDPOINT_CUSTOMER:
                $endpoint = new Customer();
                break;
        }
        return $endpoint->handleRequest($uri, $requestMethod, $queries, $payload);
    }
}