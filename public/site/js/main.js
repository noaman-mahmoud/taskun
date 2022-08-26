$(document).ready(function () {
    "use strict";
    $(".btn_shared").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
            $(this).next(".links_shared").addClass("active");
        } else {
            $(this).next(".links_shared").removeClass("active");
        }
    });

    $("body").on("click", function () {
        $(".btn_shared.active").click();
    });

    $(".btn_love").on("click", function () {
        $(this).find("i").toggleClass('fas');
    });
    

});
