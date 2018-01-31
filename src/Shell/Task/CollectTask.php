<?php
namespace Trois\Social\Shell\Task;

use Cake\ORM\TableRegistry;
use Cake\Console\Shell;

class CollectTask extends Shell
{
  public $Social;

  public $SocialPosts;

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

    $this->info('collect '.$limit.' post(s)...');
    $this->Social->query($type, $key, $limit);

    $this->success(count($this->Social->toArray()).' post(s) has/have been collected!');
    if($this->params['save'] && !empty($this->Social->toArray())) $this->save();
  }

  protected function save()
  {
    $this->info('saving posts...');
    $this->SocialPosts = TableRegistry::get($this->params['model']);
    $entities = $this->SocialPosts->newEntities($this->Social->toArray());
    $results = $this->SocialPosts->saveMany($entities);

    if(!empty($results))
    {
      $this->success(count($results).' on '.count($entities).' post(s) was/were successfully saved!');
    }else
    {
      $this->err('No recrods saved! loook at following entities errors:');
      $this->hr();

      foreach($entities as $entity)
      {
        $this->err('Entity from '.$entity->provider.' '.$entity->link);
        foreach($entity->errors() as $field => $errors)
        {
          foreach($errors as $errorType => $errorMesage)
          {
            $this->err('field "'.$field.'" has error type "'.$errorType.'" with message "'.$errorMesage.'"');
          }
        }
        $this->hr();
      }
    }
  }
}
