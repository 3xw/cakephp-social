<?php
namespace Trois\Social\Network\Http;

use Cake\I18n\I18n;
use Cake\Core\Configure;
use Facebook\Facebook as FB;

class Facebook extends Social {

  public function query($type, $key, $limit = 10)
  {
    //set up...
    $config = Configure::read('Social.facebook');
    $locale = I18n::locale();
    $this->posts = [];

    // FIX LOCALE POUR CES PT
    $locale = str_replace(['fr_CH','de_CH'],['fr_FR','de_DE'], $locale);

    //CONNECT FACEBOOK APP
    $fb = new FB($config);

    //GET POSTS
    $accessToken = $config['app_id'].'|'.$config['app_secret'];
    $postQuery = $fb->sendRequest('GET', '/'.$key.'/feed?locale='.$locale.'&fields=link,created_time,permalink_url,message,attachments,picture', [], $accessToken)->getDecodedBody();
    $datas = $postQuery['data'];

    //TRANSFORM DATA
    foreach($datas as $dataKey => $data)
    {
      if($dataKey < $limit){
        $post = [];
        $post['type'] = 'facebook';
        $post['created'] = ($data['created_time'])? date("Y-m-d H:i:s", strtotime($data['created_time'])) : null;
        $post['link'] = $data['permalink_url'] ?? null;
        $post['message'] = $data['message'] ?? null;
        $post['author'] = $config['page_name'];
        if(!empty($data['attachments'])){
          if(!empty($data['attachments']['data'][0]['media']['image']['src'])){
            $post['image'] = $data['attachments']['data'][0]['media']['image']['src'];
          }else{
            $post['image'] = $data['picture'] ?? null;
          }
        }else{
          $post['image'] = $data['picture'] ?? null;
        }
        $this->posts[$post['created']] = $post;
      }
    }

    return $this;
  }

}
