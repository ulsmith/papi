<?php
namespace Papi\Test\Middleware;

use PHPUnit\Framework\TestCase;

class ExampleOutTest extends TestCase
{
	public function setUp()
    {
        parent::setUp();

		// Do something or remove!
    }

    public function tearDown()
    {
        parent::tearDown();

		// Do something or remove!
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

		// Do something or remove!
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();

		// Do something or remove!
    }

	public function testSomething()
	{
		// Do something like creating a request and hitting the route to test middleware actions

		// check response back to see if middleware acted accordingly
		$this->assertEquals(true, true);
	}
}
