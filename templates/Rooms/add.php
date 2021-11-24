<div class="mb-1 mt-3">    
    <?= $this->Form->create($room , ['type' => 'file', 'name' => 'addHotel', 'id' => 'addHotel']) ?>
    <fieldset>
        <legend><?= __('Add a  room') ?></legend>
        <?= $this->Form->control('roon_number',['required']) ?>
        <?= $this->Form->control('hotel_id', ['options' => $hotelNames, 'class' => 'brLabel']) ?> 
        <?= $this->Form->control('room_category',['type' => 'select', 'options' => $categories]) ?>
        <?= $this->Form->control('rate',['type' => 'number', 'min' => '0', 'step' => '5', 'required']) ?>
        <?= $this->Form->control('room_img[]',['label' => 'Images', 'type' =>'file','accept' => 'image/png , image/jpeg']) ?>
        <!-- Need to allow for multiple file uploads -->
   </fieldset>
    <?= $this->Form->button('Submit', ['onclick' => 'SubmitFrm()']); ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
  addTags();
</script>
