<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobPositionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobPositionsTable Test Case
 */
class JobPositionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JobPositionsTable
     */
    public $JobPositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.JobPositions',
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
        $config = TableRegistry::getTableLocator()->exists('JobPositions') ? [] : ['className' => JobPositionsTable::class];
        $this->JobPositions = TableRegistry::getTableLocator()->get('JobPositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->JobPositions);

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
