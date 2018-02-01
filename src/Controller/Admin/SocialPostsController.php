<?php
namespace Trois\Social\Controller\Admin;

use App\Controller\AppController;

/**
* SocialPosts Controller
*
* @property \Trois\Social\Model\Table\SocialPostsTable $SocialPosts
*
* @method \Trois\Social\Model\Entity\SocialPost[] paginate($object = null, array $settings = [])
*/
class SocialPostsController extends AppController
{

  public $paginate = [
    'limit' => 250,
    'order' => [
      'SocialPosts.date' => 'desc'
    ]
  ];

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('Search.Prg', [
      'actions' => ['index']
    ]);
  }

  public function index()
  {
    $query = $this->SocialPosts
    ->find('search',['search' => $this->request->query]);
    $this->set('socialPosts', $this->paginate($query));
  }

  public function display($id = null, $provider = null, $display = 1)
  {
    $socialPost = $this->SocialPosts->get([$id, $provider], [
      'contain' => []
    ]);
    $socialPost = $this->SocialPosts->patchEntity($socialPost, ['display' => $display]);
    if ($this->SocialPosts->save($socialPost)) {
      $this->Flash->success(__('The social post has been saved.'));
    }else{
      $this->Flash->error(__('The social post could not be saved. Please, try again.'));
    }

    return $this->redirect([
      'action' => 'index',
      '?' => $this->request->query,
      '#' => $provider.'-'.$id
    ]);
  }

  public function add()
  {
    $socialPost = $this->SocialPosts->newEntity();
    if ($this->request->is('post')) {
      $socialPost = $this->SocialPosts->patchEntity($socialPost, $this->request->getData());
      if ($this->SocialPosts->save($socialPost)) {
        $this->Flash->success(__('The social post has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The social post could not be saved. Please, try again.'));
    }
    $this->set(compact('socialPost'));
    $this->set('_serialize', ['socialPost']);
  }

  public function edit($id = null, $provider = null)
  {
    $socialPost = $this->SocialPosts->get([$id, $provider], [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $socialPost = $this->SocialPosts->patchEntity($socialPost, $this->request->getData());
      if ($this->SocialPosts->save($socialPost)) {
        $this->Flash->success(__('The social post has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The social post could not be saved. Please, try again.'));
    }
    $this->set(compact('socialPost'));
    $this->set('_serialize', ['socialPost']);
  }

  public function delete($id = null, $provider = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $socialPost = $this->SocialPosts->get([$id, $provider]);
    if ($this->SocialPosts->delete($socialPost)) {
      $this->Flash->success(__('The social post has been deleted.'));
    } else {
      $this->Flash->error(__('The social post could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
