<?php
require_once 'RESTConstants.php';
require_once 'db/CarModel.php';

class APIController
{
    public function isValidEndpoint(array $uri): bool
    {
        if ($uri[0] == RESTConstants::ENDPOINT_PUBLIC or $uri[0] == RESTConstants::ENDPOINT_STOREKEEPER) {
            if (count($uri) == 1) {
                // A request for the collection of used cars
                return true;
            } elseif (count($uri) == 2) {
                // The car id must be a number
                //echo "here";
                return true;
            }

        }
        return false;
    }

    public function isValidMethod(array $uri, string $requestMethod): bool {
        switch ($uri[0]) {
            case RESTConstants::ENDPOINT_PUBLIC:
                // The only method implemented is for getting individual car resources
                return count($uri) == 2 && $requestMethod == RESTConstants::METHOD_GET;
            case RESTConstants::ENDPOINT_STOREKEEPER:
                return $requestMethod == RESTConstants::METHOD_POST;
        }
        return false;
    }

    public function isValidPayload(array $uri, string $requestMethod, array $payload): bool
    {
        // No payloads to test for GET methods
        if ($requestMethod == RESTConstants::METHOD_GET or $requestMethod == RESTConstants::METHOD_POST)  {
            return true;
        }
        return false;
    }
































    public function handleRequest(array $uri, string $requestMethod, array $queries, array $payload): array
    {
        $endpointUri = $uri[0];
        switch ($endpointUri) {
            case RESTConstants::ENDPOINT_PUBLIC:
                return $this->handleSkiGetRequest($uri, $requestMethod, $queries, $payload);
                break;
            case RESTConstants::ENDPOINT_STOREKEEPER:
                return $this->handleSkiPostRequest($uri, $requestMethod, $queries, $payload);
        }
        return array();
   }

   protected function handleSkiGetRequest(array $uri, string $requestMethod, array $queries, array $payload): array
   {
       if (count($uri) == 1) {
           $model = new skiproject();
           return $model->getCollection();
       } elseif (count($uri) == 2) {
           $model = new skiproject();
           return $model->getResource($uri[1]);
       }
       return array();
   }
   protected function handleSkiPostRequest(array $uri, string $requestMethod, array $queries, array $payload): array
   {
        $model = new skiproject();
        $resource = array("description");
        return $model->modifyResource($resource);





   }
}