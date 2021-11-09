<?php if(empty($hotels)) : ?>
        <h2>Your wish list is empty <?= $user->firstname ?>!</h2>
    <?php else : ?>
        <h2>Your Wish List <?= $user->firstname ?></h2>
            <?php foreach ($hotels as $hotel) : ?>
             <?php 
                $hotelID = $hotel['hotel_id'];
                $itemID = $hotel['item_id'];
                ?>
                <div class="card">
                    <div class="rowSpaceBetween">
                        <h2 style="margin-bottom: 10px"><?= $hotel['hotel_name']?></h2>
                         <?= $this->Html->link("Remove from wish list", ['action' => 'remove', $itemID],['class' => 'smallIdeagenBtnDanger']) ?>
                    </div>
                    <p class="mb-1"><?= $hotel['hotel_contact'] ?></p>
                    <div class="row mb-1">
                        <div class="column">
                            <div>
                                <?php 
                                    $imgArray = explode(",",$hotel['hotel_img']);
                                    echo $this->Html->image('Hotels/'.$imgArray[0], ['class' =>'hotelWishImg']) 
                                    ?>
                            </div>
                            
                            </div>
                        <div class="column ml-1">
                            <h3 class="recentBookingText">Description</h3>
                            <p class="recentBookingText"><?= $hotel['description']?></p>
                            <h3 class="recentBookingText">Tags</h3>
                            <ul class="tagList recentBookingText">
                                <?php $tags = explode(",", $hotel['tags']) ?>
                                <?php foreach ($tags as $t): ?>
                                    <li class="tags"><?= $t ?></li>
                                <?php endforeach ?>
                            </ul>
                            <?= $this->Html->link("Book a room", ['controller' => 'Hotels', 'action' => 'view', $hotelID],['class' => 'smallIdeagenBtn']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
    <?php endif ?>