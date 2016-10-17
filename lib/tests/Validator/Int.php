<?php
/**
 * @group baxe
 * @group Validator
 */
class baxe_Validator_IntTest extends PHPUnit_Framework_TestCase {

    public function testSomething() {
        // $this->assertTrue(false);

        $v = new baxe_Validator_Int();
        var_dump($v->process(1));
    }

}
