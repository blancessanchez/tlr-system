<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveApplicationResponsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveApplicationResponsesTable Test Case
 */
class LeaveApplicationResponsesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveApplicationResponsesTable
     */
    public $LeaveApplicationResponses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LeaveApplicationResponses',
        'app.Applications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LeaveApplicationResponses') ? [] : ['className' => LeaveApplicationResponsesTable::class];
        $this->LeaveApplicationResponses = TableRegistry::getTableLocator()->get('LeaveApplicationResponses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveApplicationResponses);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
