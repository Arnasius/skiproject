<?php
require_once 'RESTConstants.php';
require_once 'config/database.php';
require_once 'endpoints/customerEndpoint.php';
require_once 'endpoints/repEndpoint.php';
require_once 'endpoints/keeperEndpoint.php';
require_once 'endpoints/publicEndpoint.php';
class APIController
{
    // Checking if the endpoint access is correct
    public function isValidEndpoint($uri): bool
    {
        switch ($uri[0]) {

            case RESTConstants::ENDPOINT_PUBLIC:
            case RESTConstants::ENDPOINT_STOREKEEPER:
                if (count($uri) == 1)
                {
                    return true;
                }
                break;

            case RESTConstants::ENDPOINT_CUSTOMER_REP:
            case RESTConstants::ENDPOINT_CUSTOMER:
                if (count($uri) == 1) {

                    return true;

                } else if (count($uri) == 2) {

                    return ctype_digit($uri[1]);//check if an input is a digit

                }


        }
        return false;
    }
    //checking if the method is correct
    public function isValidMethod(array $uri, string $requestMethod): bool
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
                else if (count($uri) == 2 && $requestMethod == RESTConstants::METHOD_PUT) {
                    return true;
                }
                // print($requestMethod);
                // print(count($uri);
                return false;
            case RESTConstants::ENDPOINT_STOREKEEPER:
                if (count($uri) == 1 && $requestMethod == RESTConstants::METHOD_POST)
                {
                    return true;
                }
                return false;
            case RESTConstants::ENDPOINT_PUBLIC:
                if (count($uri) == 1 && $requestMethod == RESTConstants::METHOD_GET)
                {
                    return true;
                }
                return false;
        }
        return false;
    }
    // handling the call
    public function handleRequest($uri, $requestMethod, $queries, $payload): array
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
                $endpoint = new Keeper();
                break;
            case RESTConstants::ENDPOINT_PUBLIC:
                $endpoint = new publicEnd();
                break;
        }
        return $endpoint->handleRequest($uri, $requestMethod, $queries, $payload);
    }
}