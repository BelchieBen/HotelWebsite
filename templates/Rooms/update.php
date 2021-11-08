<div class="mb-1 mt-3">    
    <?= $this->Form->create($hotel , ['type' => 'file', 'name' => 'addHotel', 'id' => 'addHotel']) ?>
    <fieldset>
        <legend><?= __('Add a  hotel') ?></legend>
        <?= $this->Form->control('hotel_name', ['value' => $hotel->hotel_name]) ?>
        <?= $this->Form->control('description', ['value' => $hotel->description]) ?>
        <div class="input-categories">
          <?= $this->Form->control('tags', ['type' => 'text', 'value' => '']) ?>
          <ul id="tagList">
            <?php $tags = explode(",", $hotel->tags) ?>

            <?php foreach ($tags as $t): ?>
                <li class="tags pointer" onclick="removeTag(this)"><?= $t ?></li>
            <?php endforeach ?>

          </ul>
        </div>  
        <?= $this->Form->control('contact_number', ['value' => $hotel->contact_number]) ?>
        <?= $this->Form->control('hotel_img[]',['label' => 'Images', 'type' =>'file','accept' => 'image/png , image/jpeg', 'multiple']) ?>
        <!-- Need to allow for multiple file uploads -->
   </fieldset>
    <?= $this->Form->button('Submit', ['onclick' => 'SubmitFrm()']); ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
  addTags();
</script>

