<?php
namespace Trois\Social\Shell\Task;

use Trois\Social\Network\Http\Facebook;
use Cake\Console\Shell;

class FacebookTask extends Shell
{
  public $Facebook;

  public function initialize()
  {
    parent::initialize();
    $this->Facebook = new Facebook();
  }

  public function main($type = null, $key = null, $limit = null)
  {
    if($type == null){
      $type = $this->in('Which type request type?', ['account', 'search'], 'account');
    }

    if($key == null){
      $key = $this->in('Provide the needle your looking for:');
    }

    if($limit == null){
      $limit = $this->in('How much posts?', null, 10);
    }

    $posts = $this->Facebook->getLastPosts($type, $key, $limit);
    debug($posts);
  }
}
