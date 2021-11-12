$(function() {
    $(".toggle").on("click", function() {
        if ($(".item").hasClass("show")) {
            $(".item").removeClass("show");
        } else {
            $(".item").addClass("show");
        }
    });
});