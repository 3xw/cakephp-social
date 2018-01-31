<?php
namespace Trois\Social\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
* SocialPosts Model
*
* @method \Trois\Social\Model\Entity\SocialPost get($primaryKey, $options = [])
* @method \Trois\Social\Model\Entity\SocialPost newEntity($data = null, array $options = [])
* @method \Trois\Social\Model\Entity\SocialPost[] newEntities(array $data, array $options = [])
* @method \Trois\Social\Model\Entity\SocialPost|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Social\Model\Entity\SocialPost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Social\Model\Entity\SocialPost[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Social\Model\Entity\SocialPost findOrCreate($search, callable $callback = null, $options = [])
*
* @mixin \Cake\ORM\Behavior\TimestampBehavior
*/
class SocialPostsTable extends Table
{

  /**
  * Initialize method
  *
  * @param array $config The configuration for the Table.
  * @return void
  */
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('social_posts');
    $this->setDisplayField('id');
    $this->setPrimaryKey(['id','provider']);

    $this->addBehavior('Timestamp');
    $this->addBehavior('Trois/Social.MatchRequirements');

    $this->addBehavior('Search.Search');
    $this->searchManager()
    ->add('q', 'Search.Like', [
      'before' => true,
      'after' => true,
      'mode' => 'or',
      'comparison' => 'LIKE',
      'wildcardAny' => '*',
      'wildcardOne' => '?',
      'field' => ['provider','message']
    ]);

  }

  /**
  * Default validation rules.
  *
  * @param \Cake\Validation\Validator $validator Validator instance.
  * @return \Cake\Validation\Validator
  */
  public function validationDefault(Validator $validator)
  {
    $validator
    //->uuid('id')
    ->maxLength('id',36)
    ->notEmpty('id');

    $validator
    ->scalar('provider')
    ->maxLength('provider',45)
    ->notEmpty('provider');

    $validator
    ->dateTime('date')
    ->requirePresence('date')
    ->notEmpty('date');

    $validator
    ->boolean('display')
    ->allowEmpty('display');

    $validator
    ->scalar('link')
    ->maxLength('link',255)
    ->requirePresence('link')
    ->notEmpty('link');

    $validator
    ->scalar('message')
    ->allowEmpty('message');

    $validator
    ->scalar('author')
    ->maxLength('author',255)
    ->allowEmpty('author');

    $validator
    ->scalar('image')
    ->maxLength('image',255)
    ->allowEmpty('image');

    return $validator;
  }
}
