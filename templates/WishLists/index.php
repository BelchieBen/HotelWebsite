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
                            <div class="slideshowContainer">
                                <?php 
                                    $imgArray = explode(",",$hotel['hotel_img']);
                                    foreach ($imgArray as $index => $image): ?>
                                        <div class="slideshow fade">
                                            <div class="imageIndex"><?= $index ?>/ <?= count($imgArray) ?></div>
                                            <?php 
                                                echo $this->Html->image('Hotels/'.$image, ['class' =>'hotelWishImg']) 
                                            ?>
                                        </div>
                                    <?php endforeach ?>
                                    <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
                                    <a class="next" onclick="moveSlide(1)">&#10095;</a>
                            </div>
                            <div class="dots">
                                <span class="dot" onclick="currentSlide(1)"></span>
                                <span class="dot" onclick="currentSlide(2)"></span>
                                <span class="dot" onclick="currentSlide(3)"></span>
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

<script type="text/javascript">
    var slideIndex = 1;
    showSlides(slideIndex);
</script>