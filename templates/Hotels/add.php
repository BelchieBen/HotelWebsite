
<div class="mb-1 mt-3">  
  <!-- Creating the form in the CakePHP way -->
    <?= $this->Form->create($hotel , ['type' => 'file', 'name' => 'addHotel', 'id' => 'addHotel']) ?>
    <fieldset>
        <legend><?= __('Add a  hotel') ?></legend>
        <!-- The form control links to a field in the database model -->
        <?= $this->Form->control('hotel_name',['required']) ?>
        <?= $this->Form->control('description',['required']) ?>
        <div class="input-categories">
          <?= $this->Form->control('tags', ['type' => 'text', 'required']) ?>
          <!-- Shwoing the hotel tags -->
          <ul id="tagList">
          </ul>
        </div>  
        <?= $this->Form->control('contact_number',['required']) ?>
        <?= $this->Form->control('hotel_img[]',['label' => 'Images', 'type' =>'file','accept' => 'image/png , image/jpeg', 'multiple']) ?>
        <!-- Need to allow for multiple file uploads -->
   </fieldset>
    <?= $this->Form->button('Submit', ['onclick' => 'SubmitFrm()']); ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
  // Adding the tags via JavaScript
  addTags();
</script>
