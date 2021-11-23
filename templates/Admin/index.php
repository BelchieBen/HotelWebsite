
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
							<td><?= $this->Html->link("Update", ['controller' => 'Rooms','action' => 'update' , $room['roon_id']],['class' => 'updateBtn']) ?></td>
							<td><?= $this->Html->link("Delete", ['controller' => 'Rooms', 'action' => 'delete', $room['roon_id']],['class' => 'deleteBtn']) ?></td>
						</tr>
					<?php endforeach ?>		
					</tbody>
			</table>
		</div>
	</div>

	<div class="col3">
		<h1>Bookings</h1>
		<hr>
		<div class="mt-2">
			<table id="bookings" class="display">
				<thead>
					<tr>
						<td>Booking Number</td>
						<td>Hotel</td>
						<td>Room</td>
						<td>Customer</td>
						<td>Check In</td>
						<td>Check Out</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>				
					<?php foreach ($bookings as $booking): ?>
						<tr>
							<td><?= $booking->booking_id ?></td>
							<td><?= $booking->hotel->hotel_name ?></td>
							<td><?= $booking->room->roon_number ?></td>
							<td><?= $booking->user_id ?></td>
							<td><?= $booking->booking_start->format('d/m/y') ?></td>
							<td><?= $booking->booking_end->format('d/m/y') ?></td>
							<td>£<?= $booking->total ?></td>
						</tr>
					<?php endforeach ?>		
					</tbody>
			</table>
		</div>
	</div>

	<div class="col3">
		<h1>Users</h1>
		<hr>
		<div class="row mt-2">
			<div class="adduser usrBox">
				<?= $this->Html->link("Add Users", ['controller' => 'Users','action' => 'add'],['class' => 'addusr h1text']) ?>
			</div>
			<div class="updateuser usrBox">
				<button id="openTable" class="updusr h1text">Update Users</button>
			</div>
			<div class="deleteuser usrBox">
				<button id="openTableDel" class="delusr h1text">Delete Users</button>
			</div>
		</div>
	</div>

	<!-- Popup window showing all users -->
		<div id="usersPopup" class="popup popupFade">
		  <div class="popupContent padd16">
		    <span class="closeUp">&times;</span>
		    <div style="margin:16px">
		    	<table id="users" class="display">
					<thead>
						<tr>
							<td>Firstname</td>
							<td>Surname</td>
							<td>Email</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>				
						<?php foreach ($users as $usr): ?>
							<tr>
								<td><?= $usr->firstname ?></td>
								<td><?= $usr->surname ?></td>
								<td><?= $usr->email ?></td>
								<td>
									<?= $this->Html->link("Update User", ['controller' => 'Users', 'action' => 'update', $usr['id']],['class' => 'yellowbtn']) ?>
								</td>
							</tr>
						<?php endforeach ?>		
						</tbody>
				</table>
	    	</div>
		  </div>
	  	</div>

	  	<!-- Popup window showing all users -->
		<div id="usersPopupDel" class="popup popupFade">
		  <div class="popupContent padd16">
		    <span class="closeDel">&times;</span>
		    <div style="margin:16px">
		    	<table id="usersDel" class="display">
					<thead>
						<tr>
							<td>Firstname</td>
							<td>Surname</td>
							<td>Email</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>				
						<?php foreach ($users as $usr): ?>
							<tr>
								<td><?= $usr->firstname ?></td>
								<td><?= $usr->surname ?></td>
								<td><?= $usr->email ?></td>
								<td>
									<?= $this->Html->link("Delete User", ['controller' => 'Users', 'action' => 'delete', $usr['id']],['class' => 'delUsrbtn']) ?>
								</td>
							</tr>
						<?php endforeach ?>		
						</tbody>
				</table>
	    	</div>
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

	$(document).ready( function () {
    $('#bookings').DataTable();
} );
	$(document).ready( function () {
    $('#users').DataTable().columns.adjust();
} );
	$(document).ready( function () {
    $('#usersDel').DataTable().columns.adjust();
} );
	showUsersPopup();
	showUsersPopupDel();
</script>