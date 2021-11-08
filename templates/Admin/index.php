
<div class="column">
	<!-- Hotels -->
	<div class="col3">
		<h1>Hotels</h1>
		<div>
			<?= $this->Html->link("Add Hotels", ['controller' => 'Hotels','action' => 'add'],['class' => 'redbtn']) ?>
		</div>
		<hr>
		<div class="mt-2">
			<table id="hotels" class="display">
				<thead>
					<tr>
						<td>Hotel Name</td>
						<td>Description</td>
						<td>Contact Number</td>
						<td>Update</td>
						<td>Delete</td>
					</tr>
				</thead>
				<tbody>				
					<?php foreach ($hotels as $hotel): ?>
						<tr>
							<td><?= $hotel->hotel_name ?></td>
							<td><?= $hotel->description ?></td>
							<td><?= $hotel->contact_number ?></td>
							<td><?= $this->Html->link("Update", ['controller' => 'Hotels','action' => 'update' , $hotel['id']],['class' => 'updateBtn']) ?></td>
							<td><?= $this->Html->link("Delete", ['controller' => 'Hotels', 'action' => 'delete', $hotel['id']],['class' => 'deleteBtn']) ?></td>
						</tr>
					<?php endforeach ?>		
					</tbody>
			</table>
		</div>
	</div>
	<div class="col3">
		<h1>Rooms</h1>
		<div>
			<?= $this->Html->link("Add Rooms", ['controller' => 'Rooms','action' => 'add'],['class' => 'redbtn']) ?>
		</div>
		<hr>
		<div class="mt-2">
			<table id="rooms" class="display">
				<thead>
					<tr>
						<td>Room Number</td>
						<td>Hotel</td>
						<td>Room Category</td>
						<td>Rate Per Night</td>
						<td>Update</td>
						<td>Delete</td>
					</tr>
				</thead>
				<tbody>				
					<?php foreach ($rooms as $room): ?>
						<tr>
							<td><?= $room->roon_number ?></td>
							<td><?= $room->hotel->hotel_name ?></td>
							<td><?= $room->room_category ?></td>
							<td>£<?= $room->rate ?></td>
							<td><?= $this->Html->link("Update", ['controller' => 'Rooms','action' => 'update' , $hotel['id']],['class' => 'updateBtn']) ?></td>
							<td><?= $this->Html->link("Delete", ['controller' => 'Rooms', 'action' => 'delete', $hotel['id']],['class' => 'deleteBtn']) ?></td>
						</tr>
					<?php endforeach ?>		
					</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( function () {
    $('#hotels').DataTable();
} );

	$(document).ready( function () {
    $('#rooms').DataTable();
} );
</script>