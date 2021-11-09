
<div class="mb-1 mt-3">    
    <h3>Are you sure you want to remove this item from your wish list?</h3>
    <?= $this->Form->create($wishListItem , ['type' => 'post', 'class' => 'deleteFrm']) ?>
    <?= $this->Html->link("Back", ['action' => 'index'],['class' => 'ideagenBtn']) ?>
    <?= $this->Form->button(__('Remove'), ['class' => 'dangerBtn pointer']); ?>
    <?= $this->Form->end() ?>
</div>
