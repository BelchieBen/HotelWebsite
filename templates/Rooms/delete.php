
<div class="mb-1 mt-3">    
    <h3>Are you sure you want to delete room <?= $room->roon_number ?>?</h3>
    <?= $this->Form->create($room , ['type' => 'post', 'class' => 'deleteFrm']) ?>
    <?= $this->Html->link("Back", ['controller' => 'Admin', 'action' => 'index'],['class' => 'ideagenBtn']) ?>
    <?= $this->Form->button(__('Delete'), ['class' => 'dangerBtn pointer']); ?>
    <?= $this->Form->end() ?>
</div>
