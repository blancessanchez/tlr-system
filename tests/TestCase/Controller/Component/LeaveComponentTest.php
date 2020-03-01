<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\LeaveComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\LeaveComponent Test Case
 */
class LeaveComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\LeaveComponent
     */
    public $Leave;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Leave = new LeaveComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Leave);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
