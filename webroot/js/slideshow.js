// Next/previous controls
function moveSlide(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  // Get the DOM elements
  var slides = document.getElementsByClassName("slideshow");
  var dots = document.getElementsByClassName("dot");
  // Setting the slide index if there is 1 image
  if (n > slides.length) {slideIndex = 1}
  // Setting the slide index if there is more than 1 image
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  // Changing the state of the dot that is representing the current image
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
} 
