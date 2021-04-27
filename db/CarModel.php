<?php
require_once 'dbCredentials.php';

class skiproject {
    protected $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',
            DB_USER, DB_PWD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    /**
     * Returns the collection of resources from the database.
     * @param array $query an optional set of conditions that the retrieved
     *              resources need to meet - e.g., array('make' => 'Ford') would
     *              mean that only resources having make = Ford would be returned.
     * @return array an array of associative arrays of resource attributes. The
     *               array will be empty if there are no resources to be returned.
     * @throws APIException if the $query variable is incorrectly formatted
     */
    function getCollection(array $query = null): array
    {
        $res = array();

        return $res;
    }

    /**
     * Returns the collection of resources from the database.
     * @param int $id the id of the resource to be retrieved.
     * @return array an associative array of resource attributes - or null if
     *               no resources have the given id.
     */
    function getResource(string $id): array
    {
        $res = array();
        $query = 'SELECT *  FROM company WHERE company_name = :id';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
        return $res;
    }

    /**
     * Creates a new resource in the database.
     * @param array $resource the resource to be created.
     * @return array an associative array of resource attributes representing
     *               the resource - the returned value will include the id
     *               assigned to the resource.
     */
    function createResource(array $resource): array
    {
        $res = array();

        return $res;
    }

    /**
     * Modifies a resource in the database.
     * @param array $resource the resource to be modified.
     * @return array an associative array of resource attributes representing
     *               the resource after being modified.
     * @throws APIException if the $resource is missing some of the required
     *                      attributes.
     */
    function modifyResource(array $resource): array
    {
        $res = array();
        $query = "UPDATE product SET description='test test' WHERE model='active' AND ski_type='skate' AND size=142 AND weight=30";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $res;
    }

    /**
     * Deletes a resource from the database.
     * @param int $id the id of the resource to be deleted.
     * @throws APIException if the record cannot be deleted from the database,
     *                      e.g., due to foreign key constraints.
     */
    function deleteResource(int $id)
    {

    }
}
