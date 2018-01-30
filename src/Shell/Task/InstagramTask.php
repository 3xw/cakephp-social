<?php
namespace Trois\Social\Shell\Task;

use Trois\Social\Network\Http\Instagram;

class InstagramTask extends CollectTask
{
  public function initialize()
  {
    parent::initialize();
    $this->Social = new Instagram();
  }
}
