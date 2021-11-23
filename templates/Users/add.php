
<div class="mb-1 mt-3">    
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add a new user') ?></legend>

        <?= $this->Form->control('firstname') ?>
        <?= $this->Form->control('surname') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password', ['label' => 'Temporary Password']) ?>
   </fieldset>
    <?= $this->Form->button(__('Add User')); ?>
    <?= $this->Form->end() ?>
</div>
