<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ActivityLogComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ActivityLogComponent Test Case
 */
class ActivityLogComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ActivityLogComponent
     */
    public $ActivityLog;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ActivityLog = new ActivityLogComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityLog);

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
