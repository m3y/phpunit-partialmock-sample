<?php

require "vendor/autoload.php";

class PartialMockTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function originalMethodCase()
    {
        $targetClass = new \M3y\PhpunitPartialMock\Sample();
        $this->assertSame("original method.", $targetClass->get());
    }

    /**
     * @test
     */
    public function partialMockCase()
    {
        $mock = $this->getMock("\M3y\PhpunitPartialMock\Sample", array("target"));
        $mock->expects($this->any())
             ->method("target")
             ->will($this->returnValue("partial mocked method."));
        $this->assertSame("partial mocked method.", $mock->get());
    }

    /**
     * @test
     */
    public function originalMethodWithParameterCase()
    {
        $targetClass = new \M3y\PhpunitPartialMock\Sample();
        $this->assertSame("method with test parameter.", $targetClass->getWithParameter("test parameter"));
    }

    /**
     * @test
     */
    public function partialMockWithParameterCase()
    {
        $mock = $this->getMock("\M3y\PhpunitPartialMock\Sample", array("targetWithParameter"));
        $mock->expects($this->any())
             ->method("targetWithParameter")
             ->with($this->equalTo('pm test parameter'))
             ->will($this->returnValue("partial mocked method with test parameter."));
        $this->assertSame("partial mocked method with test parameter.", $mock->getWithParameter("pm test parameter"));
    }

    /**
     * @test
     */
    public function multiPartialMockCase()
    {
        $mock = $this->getMock("\M3y\PhpunitPartialMock\Sample", array(
            "target",
            "targetWithParameter",
        ));

        $mock->expects($this->any())
             ->method("target")
             ->will($this->returnValue("partial mocked method."));

        $mock->expects($this->any())
             ->method("targetWithParameter")
             ->with($this->equalTo('pm test parameter'))
             ->will($this->returnValue("partial mocked method with test parameter."));
        $this->assertSame("partial mocked method with test parameter.", $mock->getWithParameter("pm test parameter"));

        $this->assertSame("partial mocked method.", $mock->get());
        $this->assertSame("partial mocked method with test parameter.", $mock->getWithParameter("pm test parameter"));
    }
}
