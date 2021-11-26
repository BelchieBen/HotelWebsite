<div class="mb-1 mt-3">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Change your password') ?></legend>
        <!-- The form control for password connects to data model and will apply the password property automatically and then hash the password before its written to database -->
        <?= $this->Form->control('password', ['required' => true, 'label' => 'New Password']) ?>
    </fieldset>
    <?= $this->Form->button(__('Save')); ?>
    <?= $this->Form->end() ?>
</div>
