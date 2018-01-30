<?php
namespace Trois\Social\Shell\Task;

use Trois\Social\Network\Http\Facebook;

class FacebookTask extends CollectTask
{
  public function initialize()
  {
    parent::initialize();
    $this->Social = new Facebook();
  }
}
