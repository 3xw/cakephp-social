<?php
namespace Trois\Social\Network\Http;

use Cake\Http\Client;

class Instagram implements ISocial {

  public function getLastPosts($type, $key, $limit = 10)
  {
    //set up...
    $posts = [];
    $http = new Client();

    //GET POSTS
    if($type == 'account'){
      $feedUrl = 'https://www.instagram.com/'.$key.'/?__a=1';
    }elseif($type == 'search'){
      $feedUrl = 'https://www.instagram.com/explore/tags/'.$key.'/?__a=1';
    }

    $queryPosts = json_decode($http->get($feedUrl)->body());

    if($type == 'account'){
      $datas = $queryPosts->user->media->nodes;
    }elseif($type == 'search'){
      $datas = $queryPosts->graphql->hashtag->edge_hashtag_to_media->edges;
    }

    foreach($datas as $dataKey => $data){
      if($dataKey < $limit){
        $post = [];
        $post['type'] = 'instagram';
        if($type == 'account'){
          $post['created'] = ($data->date)? date("Y-m-d H:i:s", $data->date) : null;
          $post['link'] = 'https://www.instagram.com/p/'.$data->id;
          $post['message'] = $data->caption ?? null;
          $post['author'] = $queryPosts->user->full_name;
          $post['image'] = $data->display_src;
        }elseif($type == 'search'){
          $data = $data->node;
          $post['created'] = ($data->taken_at_timestamp)? date("Y-m-d H:i:s", $data->taken_at_timestamp) : null;
          $post['link'] = 'https://www.instagram.com/p/'.$data->id;
          $post['message'] = $data->edge_media_to_caption->edges[0]->node->text ?? null;
          $post['author'] = null;
          $post['image'] = $data->thumbnail_src;
        }
        $posts[$post['created']] = $post;
      }
    }

    return $posts;
  }

}
