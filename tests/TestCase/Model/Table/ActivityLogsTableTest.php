<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityLogsTable Test Case
 */
class ActivityLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityLogsTable
     */
    public $ActivityLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActivityLogs',
        'app.EmployeeInformation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityLogs') ? [] : ['className' => ActivityLogsTable::class];
        $this->ActivityLogs = TableRegistry::getTableLocator()->get('ActivityLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityLogs);

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
