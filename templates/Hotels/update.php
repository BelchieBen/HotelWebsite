<div class="mb-1 mt-3">    
    <?= $this->Form->create($room , ['type' => 'file', 'name' => 'addRoom', 'id' => 'addRoom']) ?>
    <fieldset>
        <legend><?= __('Update a  room') ?></legend>
        <?= $this->Form->control('roon_number', ['value' => $room->roon_number]) ?> 
        <?= $this->Form->control('room_category', ['value' => $room->room_category]) ?> 
        <?= $this->Form->control('rate', ['value' => $room->rate]) ?>
        <?= $this->Form->control('room_img[]',['label' => 'Images', 'type' =>'file','accept' => 'image/png , image/jpeg', 'multiple']) ?>
        <!-- Need to allow for multiple file uploads -->
   </fieldset>
    <?= $this->Form->button('Submit', ['onclick' => 'SubmitFrm()']); ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
  addTags();
</script>

