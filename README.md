# cakephp-social plugin for CakePHP.
Bring social networks to your website

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

	composer require 3xw/cakephp-social

Load it in your config/boostrap.php

	Plugin::load('Trois/Social', ['routes' => true]);
	
In your database settings allow correct utf8 in app.php:
	
	...
	Datasources => [
		'default' => [
			...
			'encoding' => 'utf8mb4',
			...
		]
	],
	...
	
	'Social' => [
      'facebook' => [
          'app_id' => 'XXX',
          'app_secret' => 'XXX',
          'default_graph_version' => 'v2.11',
      ],
      'twitter' => [
          'oauth_access_token' => 'XXX',
          'oauth_access_token_secret' => 'XXX',
          'consumer_key' => 'XXX',
          'consumer_secret' => 'XXX'
      ],
    ],
    ...
	
### dB
Create a table db to store the posts, we suggest following if you use the plugin table class:
	
	CREATE TABLE `social_posts` (
	  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `provider` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'facebook',
	  `date` datetime NOT NULL,
	  `created` datetime NOT NULL,
	  `modified` datetime NOT NULL,
	  `display` tinyint(1) NOT NULL DEFAULT '1',
	  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `message` text COLLATE utf8mb4_unicode_ci,
	  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  PRIMARY KEY (`id`,`provider`),
	  KEY `provider` (`provider`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 
	
## Usage

### Shell
	bin/cake social [facebook | instagram | twitter] [account | search] [needle] [limit] [-s] [-m table class]
	
### code
You have three classes (Facebook, Instagram, Twitter) that implements:
	
	public $posts = [];
	
	public function query($type, $key, $limit = 10);
	
	public function toArray();
	
You can use it like so:
	
	use Trois\Social\Network\Http\Facebook;
	
	$this->Facebook = new Facebook();
	$this->Facebook->query('account, 'xxxxyyyy', 10); // searchType, needle, limit
	debug($Facebook->toArray());
	
You have a model too:

	use Cake\ORM\TableRegistry;
	
	$this->SocialPosts = TableRegistry::get('Trois/Social.SocialPosts');
   	$entities = $this->SocialPosts->newEntities($this->Facebook->toArray());
   	$results = $this->SocialPosts->saveMany($entities);
   	
### Admin
if you have an admin, you can visit:

	/admin/social
	
and modarate the content of the table 'Trois/Social.SocialPosts'