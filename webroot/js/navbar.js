// JQuery function to open and close the hamburger menu on the navbar
$(function() {
    $(".toggle").on("click", function() {
        if ($(".item").hasClass("show")) {
            $(".item").removeClass("show");
        } else {
            $(".item").addClass("show");
        }
    });
});