<?php
namespace Trois\Social\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SocialPostsTable extends Table
{

  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('social_posts');
    $this->setDisplayField('id');
    $this->setPrimaryKey('id');

    $this->addBehavior('Timestamp');
    $this->addBehavior('MatchRequirements');
  }

  public function validationDefault(Validator $validator)
  {
    $validator
    ->uuid('id')
    ->allowEmpty('id');

    $validator
    ->scalar('provider')
    ->maxLength('provider',45)
    ->requirePresence('provider')
    ->notEmpty('provider');

    $validator
    ->dateTime('date')
    ->requirePresence('date')
    ->notEmpty('date');

    $validator
    ->boolean('display')
    ->requirePresence('display')
    ->notEmpty('display');

    $validator
    ->scalar('link')
    ->maxLength('link', 255)
    ->requirePresence('link')
    ->notEmpty('link');

    $validator
    ->scalar('message')
    ->allowEmpty('message');

    $validator
    ->scalar('author')
    ->maxLength('author', 255)
    ->allowEmpty('author');

    $validator
    ->scalar('image')
    ->maxLength('image', 255)
    ->allowEmpty('image');

    return $validator;
  }
}
