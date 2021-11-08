<div class="mb-1 mt-3">    
    <?= $this->Form->create($room , ['type' => 'file', 'name' => 'addHotel', 'id' => 'addHotel']) ?>
    <fieldset>
        <legend><?= __('Add a  room') ?></legend>
        <?= $this->Form->control('roon_number') ?>
        <?= $this->Form->control('hotel_id', ['options' => $hotels]) ?> 
        <?= $this->Form->control('room_category') ?>
        <?= $this->Form->control('rate',['type' => 'number', 'min' => '0', 'step' => '5']) ?>
        <?= $this->Form->control('room_img[]',['label' => 'Images', 'type' =>'file','accept' => 'image/png , image/jpeg', 'multiple']) ?>
        <!-- Need to allow for multiple file uploads -->
   </fieldset>
    <?= $this->Form->button('Submit', ['onclick' => 'SubmitFrm()']); ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
  addTags();
</script>
