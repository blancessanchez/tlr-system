<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveBalancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveBalancesTable Test Case
 */
class LeaveBalancesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveBalancesTable
     */
    public $LeaveBalances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LeaveBalances',
        'app.EmployeeInformation',
        'app.LeaveTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LeaveBalances') ? [] : ['className' => LeaveBalancesTable::class];
        $this->LeaveBalances = TableRegistry::getTableLocator()->get('LeaveBalances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveBalances);

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
