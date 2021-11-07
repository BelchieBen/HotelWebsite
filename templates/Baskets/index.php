<div class="col1">
	<h2>Your basket <?= $user->firstname ?></h2>

	<table>
		<thead>
			<tr>
				<td>Room</td>
				<td>Room number</td>
				<td>Room Type</td>
				<td>Check-in</td>
				<td>Check-out</td>
				<td>Total</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rooms as $room) : ?>
				<tr>
					<td><?php echo $this->Html->image('Rooms/'.$room['room_img'], ['class' =>'roomImg']) ?></td>
					<td>Room <?= $room['roon_number'] ?></td>
					<td><?= $room['room_category'] ?></td>
					<td><?= $room['from'] ?></td>
					<td><?= $room['to'] ?></td>
					<td>£<?= $room['total']  ?></td>
					<td><?= $this->Html->link("Remove", ['action' => 'remove', $room['item_id']],['class' => 'dangerBtn']) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?= $this->Html->link("Checkout", ['action' => 'checkout'],['class' => 'ideagenBtn']) ?>
</div>