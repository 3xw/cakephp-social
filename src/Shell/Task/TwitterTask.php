<?php
namespace Trois\Social\Shell\Task;

use Trois\Social\Network\Http\Twitter;

class TwitterTask extends CollectTask
{
  public function initialize()
  {
    parent::initialize();
    $this->Social = new Twitter();
  }
}
