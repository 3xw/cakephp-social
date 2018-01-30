<?php
namespace Trois\Social\Network\Http;

use Cake\I18n\I18n;
use Cake\Core\Configure;
use TwitterAPIExchange;

class Twitter extends Social {

  public function query($type, $key, $limit = 10)
  {
    //set up...
    $config = Configure::read('Social.twitter');
    $locale = I18n::locale();
    $this->posts = [];

    // FIX LOCALE POUR CES PT
    $locale = str_replace(['fr_CH','de_CH'],['fr_FR','de_DE'], $locale);

    //CONNECT TWITTER APP
    $twitter = new TwitterAPIExchange($config);
    //GET POSTS
    if($type == 'account'){
      $feedUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
      $getfield = '?screen_name='.$key.'&include_entities=true';
    }elseif($type == 'search'){
      $feedUrl = 'https://api.twitter.com/1.1/search/tweets.json';
      $getfield = '?q=#'.$key;
    }
    $postQuery = $twitter->setGetfield($getfield)
    ->buildOauth($feedUrl, 'GET')
    ->performRequest();
    $datas = json_decode($postQuery);

    if($type == 'search'){
      $datas = $datas->statuses;
    }

    foreach($datas as $dataKey => $data){
      if($dataKey < $limit){
        $post = [];
        $post['type'] = 'twitter';
        $post['created'] = ($data->created_at)? date("Y-m-d H:i:s", strtotime($data->created_at)) : null;
        if($type == 'account'){
          $post['link'] = 'https://twitter.com/'.$key.'/status/'.$data->id;
        }elseif($type == 'search'){
          $post['link'] = 'https://twitter.com/'.$data->user->screen_name.'/status/'.$data->id;
        }
        $post['message'] = $data->text ?? null;
        $post['author'] = $data->user->screen_name ?? null;
        $post['image'] = null;
        $this->posts[$post['created']] = $post;
      }
    }

    return $this;
  }

}
