<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveCategoriesTable Test Case
 */
class LeaveCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveCategoriesTable
     */
    public $LeaveCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LeaveCategories',
        'app.Leaves'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LeaveCategories') ? [] : ['className' => LeaveCategoriesTable::class];
        $this->LeaveCategories = TableRegistry::getTableLocator()->get('LeaveCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveCategories);

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
