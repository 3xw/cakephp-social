<?php
namespace Trois\Social\Test\TestCase\Shell\Task;

use Cake\TestSuite\TestCase;
use Trois\Social\Shell\Task\CollectTask;

/**
 * Trois\Social\Shell\Task\CollectTask Test Case
 */
class CollectTaskTest extends TestCase
{

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \Trois\Social\Shell\Task\CollectTask
     */
    public $Collect;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();

        $this->Collect = $this->getMockBuilder('Trois\Social\Shell\Task\CollectTask')
            ->setConstructorArgs([$this->io])
            ->getMock();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Collect);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
