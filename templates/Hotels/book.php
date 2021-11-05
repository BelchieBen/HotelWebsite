<div class="col1">
	<h2>Confirm Booking</h2>
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
			<tr>
				<td><?php echo $this->Html->image('Rooms/'.$room->room_img, ['class' =>'roomImg']) ?></td>
				<td>Room <?= $room->roon_number ?></td>
				<td><?= $room->room_category ?></td>
				<td><?= $from ?></td>
				<td><?= $to ?></td>
				<td>£<?= $total  ?></td>
				<td>
					<?= $this->Form->create()  ?>
						<?= $this->Form->button(__('Add to basket', ['class' => 'ideagenBtn'])); ?>
    				<?= $this->Form->end() ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>