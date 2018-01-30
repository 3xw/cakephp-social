<?php
namespace Trois\Social\Shell\Task;

use Cake\Console\Shell;

class CollectTask extends Shell
{
  public $Social;

  public function main($type = null, $key = null, $limit = null)
  {
    if($type == null){
      $type = $this->in('Which type request type?', ['account', 'search'], 'account');
    }

    if($key == null){
      $key = $this->in('Provide the needle your looking for:', null, '236347580160118');
    }

    if($limit == null){
      $limit = $this->in('How much posts?', null, 10);
    }

    $posts = $this->Social->getLastPosts($type, $key, $limit);
    debug($posts);
  }
}
