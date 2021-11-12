<h1>Hotels</h1>
<p>Find your perfect holiday in one of our amazing hotels!</p>
<div class="row">
	<?php foreach ($hotels as $hotel): ?>
		<div class="cardrow3">
			<?php 
				$imgArray = explode(",",$hotel->hotel_img);
				echo $this->Html->image('Hotels/'.$imgArray[0], ['class' =>'hotelImg', 'url' => ['controller' => 'Hotels', 'action' => 'view', $hotel['id'] ]]) 
			?>
			<h3><?= $hotel->hotel_name ?></h3>
		</div>
	<?php endforeach; ?>
</div>

