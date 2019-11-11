<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HolidaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HolidaysTable Test Case
 */
class HolidaysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HolidaysTable
     */
    public $Holidays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Holidays'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Holidays') ? [] : ['className' => HolidaysTable::class];
        $this->Holidays = TableRegistry::getTableLocator()->get('Holidays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Holidays);

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
