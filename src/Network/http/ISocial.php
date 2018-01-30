<?php
namespace Trois\Social\Network\Http;

interface ISocial
{
  public function getLastPosts($type, $key, $limit = 10);
}
