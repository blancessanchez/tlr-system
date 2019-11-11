<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveTypesTable Test Case
 */
class LeaveTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveTypesTable
     */
    public $LeaveTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LeaveTypes',
        'app.LeaveApplications',
        'app.LeaveBalances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LeaveTypes') ? [] : ['className' => LeaveTypesTable::class];
        $this->LeaveTypes = TableRegistry::getTableLocator()->get('LeaveTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveTypes);

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
}
