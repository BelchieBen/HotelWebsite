<div class="row">
	<div class="col1">
		<div class="slideshowContainer">
		<?php 
			$imgArray = explode(",",$hotel->hotel_img);
			foreach ($imgArray as $index => $image): ?>
				<div class="slideshow fade">
					<div class="imageIndex"><?= $index ?>/ <?= count($imgArray) ?></div>
					<?php 
						echo $this->Html->image('Hotels/'.$image, ['class' =>'viewpgimg']) 
					?>
				</div>
			<?php endforeach ?>
			<a class="prev" onclick="moveSlide(-1)">&#10094;</a>
  			<a class="next" onclick="moveSlide(1)">&#10095;</a>
		</div>
		<div class="dots">
		<?php foreach ($imgArray as $index => $image): ?>
		  	<span class="dot"></span>
		  <?php endforeach ?>
		</div>
		<div class="mt-2">
			<?= $this->Html->link("Add hotel to wish list", ['controller' => 'WishLists', 'action' => 'add', $hotel->id],['class' => 'ideagenBtn']) ?>
		</div>

		
	</div>
	<div class="col2">
		<h3><?= $hotel->hotel_name ?></h3>

		<h3>Description</h3>
		<p class="mb-2"><?= $hotel->description ?></p>

		<h3 class="mb-0">Tags</h3>
		<ul class="tagList">
			<?php $tags = explode(",", $hotel->tags) ?>
			<?php foreach ($tags as $t): ?>
				<li class="tags"><?= $t ?></li>
			<?php endforeach ?>
		</ul>

		<div>
			<h3>Select a date</h3>
			<input type="date" id="startDate" name="startDate" onchange="showEndDate()">
			<input type="date" id="endDate" name="endDate" onchange="getDates()">
			<br>
			<a href="#" id="viewRooms" class="bottombtn">View Rooms</a>
		</div>

		<!-- Popup window showing all rooms for hotel -->
		<div id="roomsPopup" class="popup popupFade">
		  <div class="popupContent">
		    <span class="close">&times;</span>
		    	<!-- Adding Rooms -->
		    	
			</div>
		  </div>

		</div>
		
</div>



<script type="text/javascript">
	var slideIndex = 1;
  	showSlides(slideIndex);
  	showPopup();

  	function sendDatesToServer(datesUserSelected) 
	{
		var url = window.location.pathname;
		var id = url.substring(url.lastIndexOf('/') + 1);
		$.ajax({
			type: 'POST',
			//url: '/HotelWebsite/hotels/view/'+id,
			data: {datesUserSelected},
			headers: {
			'X-CSRF-Token': "<?= $this->request->getAttribute('csrfToken'); ?>"
		 	},
		 	success: function(response){
		 		console.log(response);
		 		$('.popupContent').append(response);
		 		//$("<p>"+response+"</p>").replaceAll("html")
		 		$('.popupContent').show(response);

		 	}
		 	
		})
	}
</script>