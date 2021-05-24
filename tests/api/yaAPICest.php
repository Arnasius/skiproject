<?php

class yaAPICest
{
    public function _before(ApiTester $I)
    {
    }



    public function getCustomerTest(ApiTester $I)
    {
        $I->sendGet('customer');
        $I->seeResponseCodeIs(200);
        $I->seeResponseisjson();
        $I->seeResponseContainsJson(['prod_plan_id'=>1]);


    }



    public function putNonExistingOrder(ApiTester $I)
    {
        $I->sendPut('customer-rep/5');
        $I->seeResponseCodeIs(404);
    }
}

