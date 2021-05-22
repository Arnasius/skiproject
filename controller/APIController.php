<?php
require_once 'RESTConstants.php';
require_once 'config/database.php';
require_once 'endpoints/customerEndpoint.php';
require_once 'endpoints/repEndpoint.php';
require_once 'endpoints/keeperEndpoint.php';
class APIController
{

    public function isValidEndpoint($uri)
    {
        switch ($uri[0]) {
            case RESTConstants::ENDPOINT_CUSTOMER_REP:
            case RESTConstants::ENDPOINT_CUSTOMER:
                if (count($uri) == 1) {
                    return true;
                } else if (count($uri) == 2) {
                    return ctype_digit($uri[1]);//check if an input is a digit
                }
            case RESTConstants::ENDPOINT_STOREKEEPER:
                if (count($uri) == 1)
                {
                    return true;
                }
        }
        return false;
    }

    public function isValidMethod(array $uri, string $requestMethod)
    {
        switch ($uri[0])
        {
            case RESTConstants::ENDPOINT_CUSTOMER:
                if (count($uri) == 1 && $requestMethod == RESTConstants::METHOD_GET)
                {
                    return true;
                }
                else if (count($uri) == 2 && $requestMethod == RESTConstants::METHOD_DELETE)
                {
                    return true;
                }
                return false;
            case RESTConstants::ENDPOINT_CUSTOMER_REP:
                if (count($uri) == 1 && $requestMethod == RESTConstants::METHOD_GET)
                {
                    return true;
                }
                else if (count($uri) == 2 && $requestMethod == RESTConstants::METHOD_PUT)
                {
                    return true;
                }
                return false;
            case RESTConstants::ENDPOINT_STOREKEEPER:
                if (count($uri) == 1 && $requestMethod == RESTConstants::METHOD_POST)
                {
                    return true;
                }
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
            case RESTConstants::ENDPOINT_CUSTOMER_REP:
                $endpoint = new cRep();
                break;
            case RESTConstants::ENDPOINT_STOREKEEPER:
                $endpoint = Keeper();
        }
        return $endpoint->handleRequest($uri, $requestMethod, $queries, $payload);
    }
}