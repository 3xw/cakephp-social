<?php
namespace Trois\Social\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Trois\Social\Model\Table\SocialPostsTable;

/**
 * Trois\Social\Model\Table\SocialPostsTable Test Case
 */
class SocialPostsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Trois\Social\Model\Table\SocialPostsTable
     */
    public $SocialPosts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.trois/social.social_posts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SocialPosts') ? [] : ['className' => SocialPostsTable::class];
        $this->SocialPosts = TableRegistry::get('SocialPosts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SocialPosts);

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
