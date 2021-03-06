<?php
namespace Trois\Social\Network\Http;

use Cake\Http\Client;

class Instagram extends Social {

  public function query($type, $key, $limit = 10)
  {
    //set up...
    $this->posts = [];
    $datas = [];
    $http = new Client();

    //GET POSTS
    if($type == 'account'){
      $feedUrl = 'https://www.instagram.com/'.$key.'/?__a=1';
    }elseif($type == 'search'){
      $feedUrl = 'https://www.instagram.com/explore/tags/'.$key.'/?__a=1';
    }

    $queryPosts = json_decode($http->get($feedUrl)->body());

    if($type == 'account'){
      $datas = (!empty($queryPosts->graphql->user->edge_owner_to_timeline_media->edges))? $queryPosts->graphql->user->edge_owner_to_timeline_media->edges: [];
    }elseif($type == 'search'){
      $datas = (!empty($queryPosts->graphql->hashtag->edge_hashtag_to_media->edges))? $queryPosts->graphql->hashtag->edge_hashtag_to_media->edges: [];
    }

    foreach($datas as $dataKey => $data){
      if($dataKey < $limit){
        $post = [];
        $post['provider'] = 'instagram';
        $post['type'] = $type;
        $post['link'] = 'https://www.instagram.com/p/'.$data->node->shortcode;
        if($type == 'account'){
          $post['date'] = ($data->date)? date("Y-m-d H:i:s", $data->date) : null;
          $post['message'] = $data->caption ?? null;
          $post['author'] = $queryPosts->user->full_name;
          $post['image'] = $data->display_src;
        }elseif($type == 'search'){
          $data = $data->node;
          $post['date'] = ($data->taken_at_timestamp)? date("Y-m-d H:i:s", $data->taken_at_timestamp) : null;
          $post['message'] = $data->edge_media_to_caption->edges[0]->node->text ?? null;
          $post['author'] = null;
          $post['image'] = $data->thumbnail_src;
        }
        $this->posts[] = array_merge((array)$data, $post);
      }
    }

    return $this;
  }

}
