<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServiceCreditHistoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServiceCreditHistoryTable Test Case
 */
class ServiceCreditHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ServiceCreditHistoryTable
     */
    public $ServiceCreditHistory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ServiceCreditHistory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ServiceCreditHistory') ? [] : ['className' => ServiceCreditHistoryTable::class];
        $this->ServiceCreditHistory = TableRegistry::getTableLocator()->get('ServiceCreditHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ServiceCreditHistory);

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
