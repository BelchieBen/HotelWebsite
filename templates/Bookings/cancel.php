
<div class="mb-1 mt-3">    
    <h3>Are you sure you want to cancel your booking: <?= $booking->booking_id ?> ?</h3>
    <?= $this->Form->create($booking , ['type' => 'post', 'class' => 'deleteFrm']) ?>
    <?= $this->Html->link("Back", ['controller' => 'Admin', 'action' => 'index'],['class' => 'ideagenBtn']) ?>
    <?= $this->Form->button(__('Cancel'), ['class' => 'dangerBtn pointer']); ?>
    <?= $this->Form->end() ?>
</div>
