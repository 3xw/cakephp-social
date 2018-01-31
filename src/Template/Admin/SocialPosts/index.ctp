<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Social Posts') ?> <span class="badge badge-info"><?= $this->Paginator->counter('{{count}}')?></span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">add</i> '.__('Add'),['action'=>'add'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth') ?>
    <!-- LIST ELEMENT -->
    <div class="card">
      <!-- START CONTEMT -->
      <div class="card-body">
        <?= $this->Form->create('Search', ['novalidate', 'class'=>'', 'role'=>'search']) ?>
        <?= $this->Form->input('q', ['class'=>'form-control', 'placeholder'=>__('Search...'), 'label'=>false]) ?>
        <?= $this->Form->end() ?>
        <figure class="figure figure--table">

          <table id="datatables" class="table table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
            <thead class="thead-default">
              <tr>
                <th></th>
                <th></th>
                <th><?= $this->Paginator->sort('message') ?></th>
                <th><?= $this->Paginator->sort('provider') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($socialPosts as $socialPost): ?>
                <tr>
                  <td>
                    <?= $socialPost->display?  $this->Html->tag('i','done',['class' => 'material-icons text-success']): $this->Html->tag('i','cancel',['class' => 'material-icons text-danger']) ?>
                  </td>
                  <td>
                    <?= !empty($socialPost->image)? $this->Html->tag('img',null, ['src' => $socialPost->image, 'width' => '50px']): '' ?>
                  </td>
                  <td data-title="message"><?= h($socialPost->message) ?></td>
                  <td data-title="provider"><?= h($socialPost->provider) ?></td>
                  <td data-title="date"><?= h($socialPost->date) ?></td>
                  <td data-title="actions" class="actions" class="text-right">
                    <div class="btn-group">
                      <?= $this->Html->link('<i class="material-icons">visibility</i>', $socialPost->link,['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false, 'target' => '_blank']) ?>
                      <?= $this->Html->link('<i class="material-icons">mode_edit</i>', ['action' => 'edit', $socialPost->id, $socialPost->provider], ['class' => 'btn btn-xs btn-simple btn-warning btn-icon edit','escape' => false]) ?>
                      <?= $this->Form->postLink('<i class="material-icons">delete</i>', ['action' => 'delete', $socialPost->id, $socialPost->provider], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $socialPost->id)]) ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </figure>
      </div>
      <!-- END CONTEMT -->
      <!-- START FOOTER -->
      <div class="card-footer">
        <div class="row no-gutters">
          <div class="col-6">
            <?=
            $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')])
            ?>
          </div>
          <div class="col-6">
            <nav aria-label="pagination">
              <ul class="pagination justify-content-end">
                <?= $this->Paginator->prev(__('Prev')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Next')) ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- END FOOTER -->
    </div><!-- end content-->
  </div><!-- end card-->
</div><!-- end col-xs-12-->
