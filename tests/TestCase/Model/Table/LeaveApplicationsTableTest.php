<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeavesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeavesTable Test Case
 */
class LeavesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeavesTable
     */
    public $Leaves;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Leaves',
        'app.EmployeeInformation',
        'app.LeaveTypes',
        'app.LeaveCategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Leaves') ? [] : ['className' => LeavesTable::class];
        $this->Leaves = TableRegistry::getTableLocator()->get('Leaves', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Leaves);

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
