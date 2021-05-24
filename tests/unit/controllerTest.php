<?php
require_once 'controller/APIController.php';

class controllerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests


    public function testIsInvalidCustomerRepEndpoint()
    {
        $controller = new APIcontroller();
        self::assertEquals(false, $controller->isValidEndpoint(['customer-rep', 'asd'], 'PUT', [], []));
    }


    public function testIdVerification()
    {
        $controller = new APIController();
        $res = $controller->handleRequest(['customer', '1'], 'GET', [], []);

        self::assertNotEmpty($res);
        if (isset($res['order_id'])) {
            self::assertEquals(1, $res['order_id']);
        }
    }
}
