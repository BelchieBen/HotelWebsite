<h1>Hotels</h1>
<div class="row">
	<?php foreach ($hotels as $hotel): ?>
		<div class="cardrow3">
			<?php 
				$imgArray = explode(",",$hotel->hotel_img);
				echo $this->Html->image('Hotels/'.$imgArray[0], ['class' =>'hotelImg', 'url' => ['controller' => 'Hotels', 'action' => 'view', $hotel['id'] ]]) 
			?>
		</div>
	<?php endforeach; ?>
</div>

