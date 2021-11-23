
<div class="mb-1 mt-3">    
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Update '.$user->firstname) ?></legend>

        <?= $this->Form->control('firstname') ?>
        <?= $this->Form->control('surname') ?>
        <?= $this->Form->control('email') ?>
   </fieldset>
    <?= $this->Form->button(__('Update User')); ?>
    <?= $this->Form->end() ?>
</div>
