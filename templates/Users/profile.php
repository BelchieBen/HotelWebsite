<div class="profileCard">
    <div class="row">
        <div class="imgContainer">
            <?php echo $this->Html->image('Profiles/'.$user->profile_img, ['class' =>'profileImg'])  ?>
        </div>
        <div class="details">
            <h1 style="margin-bottom: 10px;"><?= $user->firstname ?> <?= $user->surname?></h1>
            <p><?= $user->email ?></p>
            <?php if ($user->role == "admin"): ?>
                <p style="margin-top: 10px;"><?= $user->role ?></p>
            <?php endif ?>
        </div>
    </div>
    <button id="edit" class="yellowbtn mt-3">Edit Details</button>
    <button id="cancel" class="cancelbtn mt-3">Cancel</button>
    <div id="edit_profile" class="mb-1 mt-3 edit">    
        <?= $this->Form->create($user , ['type' => 'file']) ?>
        <fieldset>
            
            <?= $this->Form->control('firstname') ?>
            <?= $this->Form->control('surname') ?>
            <?= $this->Form->control('email') ?>
            <?= $this->Form->control('profile_img',['label' => 'Images', 'type' =>'file','accept' => 'image/png , image/jpeg']) ?>
            <!-- Need to allow for multiple file uploads -->
       </fieldset>
        <?= $this->Form->button('Submit'); ?>
        <?= $this->Form->end() ?>
    </div> 
</div>

<div>
    <h1>Recent Bookings</h1>
    <?php foreach ($recentBookings as $booking) : ?>
        <div class="card">
            <h2 style="margin-bottom: 10px"><?= $booking['hotel_name']?></h2>
            <p class="mb-1"><?= $booking['hotel_contact'] ?></p>
            <div class="row mb-1">
                <?php echo $this->Html->image('Rooms/'.$booking['room_img'], ['class' =>'roomsImg']) ?><br>
                <div class="column ml-1">
                    <b class="recentBookingText">Booking reference: <?= $booking['booking_id'] ?></b>
                    <p class="recentBookingText">Room: <?= $booking['room_number']?></p>
                    <p class="recentBookingText"><?= $booking['room_category']?> Room</p>
                    <p class="recentBookingText">Check-in: <?= $booking['check_in'] ?></p>
                    <p class="recentBookingText">Check-out: <?= $booking['check_out'] ?></p>
                    <p class="recentBookingText">Number of nights: <?= $booking['days'] ?></p>
                    <p class="recentBookingText">Total Paid £<?= $booking['total'] ?></p>
                </div>
            </div>
            <?= $this->Html->link("Cancel Booking", ['controller' => 'Bookings', 'action' => 'cancel', $booking['booking_id']],['class' => 'dangerBtn']) ?>
        </div>
    <?php endforeach ?>
</div>

<script type="text/javascript">editProfile()</script>