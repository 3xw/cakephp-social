<?php
namespace Trois\Social\Test\TestCase\Model\Behavior;

use Cake\TestSuite\TestCase;
use Trois\Social\Model\Behavior\MatchRequirementsBehavior;

/**
 * Trois\Social\Model\Behavior\MatchRequirementsBehavior Test Case
 */
class MatchRequirementsBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Trois\Social\Model\Behavior\MatchRequirementsBehavior
     */
    public $MatchRequirements;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->MatchRequirements = new MatchRequirementsBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MatchRequirements);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
