<?php
namespace Trois\Social\Shell\Task;

use Cake\Console\Shell;

class CollectTask extends Shell
{
  public $Social;

  public function getOptionParser()
  {
    $parser = parent::getOptionParser();
    $parser
    ->addOption('save', [
        'short' => 's',
        'help' => __('Save the post'),
        'boolean' => true
    ])
    ->addOption('model', [
        'short' => 'm',
        'help' => __('Specify a model to save the posts with...'),
        'default' => 'Trois/Social.SocialPosts',
    ]);
    return $parser;
  }

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

    $this->Social->query($type, $key, $limit);

    debug($this->Social->toArray());

    if($this->params['save']) $this->save();
  }

  protected function save()
  {
    debug('save!');
  }
}
