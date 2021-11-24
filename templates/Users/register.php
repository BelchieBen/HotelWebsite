
<div class="mb-1 mt-3">    
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Sign Up!') ?></legend>
        <?= $this->Form->control('firstname') ?>
        <?= $this->Form->control('surname') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
   </fieldset>
    <?= $this->Form->button(__('Submit')); ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link("Have an account?", ['action' => 'login'],['class' => 'ideagenLink']) ?>
</div>
