<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Social Posts') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $socialPost->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete', $socialPost->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $socialPost->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">

    <div class="card">

      <!-- CONTENT -->
      <div class="card-body">
        <figure class="figure figure--table">

        <table class="table">
          <tbody>
                                                <tr>
              <th scope="row"><?= __('Id') ?></th>
              <td><?= h($socialPost->id) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Provider') ?></th>
              <td><?= h($socialPost->provider) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Link') ?></th>
              <td><?= h($socialPost->link) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Author') ?></th>
              <td><?= h($socialPost->author) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Image') ?></th>
              <td><?= h($socialPost->image) ?></td>
            </tr>
                                                                                                <tr>
              <th scope="row"><?= __('Date') ?></th>
              <td><?= h($socialPost->date) ?></td>
            </tr>
                        <tr>
              <th scope="row"><?= __('Created') ?></th>
              <td><?= h($socialPost->created) ?></td>
            </tr>
                        <tr>
              <th scope="row"><?= __('Modified') ?></th>
              <td><?= h($socialPost->modified) ?></td>
            </tr>
                                                            <tr>
              <th scope="row"><?= __('Display') ?></th>
              <td><?= $socialPost->display ? __('Yes') : __('No'); ?></td>
            </tr>
                                  </tbody>
        </table>
      </figure>

                        <div class="row">
          <div class="col-sm-12">
            <h4><?= __('Message') ?></h4>
            <?= $this->Text->autoParagraph(h($socialPost->message)); ?>
          </div>
        </div>
                      </div>
    </div>
  </div>
</div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
      </div>
</div>
<div class="utils--spacer-default"></div>
