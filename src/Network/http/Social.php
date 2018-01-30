<?php
namespace Trois\Social\Network\Http;

class Social
{

  public $posts = [];

  public function toArray()
  {
    return $this->posts;
  }

  public function query($type, $key, $limit = 10)
  {
    return $this;
  }
}
