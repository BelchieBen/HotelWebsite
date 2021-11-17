<div class="mb-1 mt-3">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Change your password') ?></legend>
        <?= $this->Form->control('password', ['required' => true, 'label' => 'New Password']) ?>
    </fieldset>
    <?= $this->Form->button(__('Save')); ?>
    <?= $this->Form->end() ?>
</div>
