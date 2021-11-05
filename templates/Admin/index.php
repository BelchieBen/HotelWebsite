
<div class="row">
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
						<td>Hotel</td>
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
							<td><?= $this->Html->link("Update", ['controller' => 'Hotels','action' => 'update' , $hotel['id']],['class' => 'yellowbtn']) ?></td>
							<td><?= $this->Html->link("Delete", ['controller' => 'Hotels', 'action' => 'delete', $hotel['id']],['class' => 'dangerBtn']) ?></td>
						</tr>
					<?php endforeach ?>		
					</tbody>
			</table>
		</div>
	</div>
	<div class="col3">
		<h1>Resturants</h1>
	</div>
</div>

<div class="col3">
		<h1>Spas</h1>
	</div>

<script type="text/javascript">
	$(document).ready( function () {
    $('#hotels').DataTable();
} );
</script>