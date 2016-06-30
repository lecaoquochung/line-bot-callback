<?php
namespace LineBotCallback\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use LineBotCallback\Model\Table\LineCallbacksTable;

/**
 * LineBotCallback\Model\Table\LineCallbacksTable Test Case
 */
class LineCallbacksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \LineBotCallback\Model\Table\LineCallbacksTable
     */
    public $LineCallbacks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.line_bot_callback.line_callbacks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LineCallbacks') ? [] : ['className' => 'LineBotCallback\Model\Table\LineCallbacksTable'];
        $this->LineCallbacks = TableRegistry::get('LineCallbacks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LineCallbacks);

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
