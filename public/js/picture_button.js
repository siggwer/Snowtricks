//function button picture
$(function() {

    $(".trick-picture").on("click", function() {
        $("#trick_pictures").append(($("#trick_pictures").data("prototype")).replace(/__name__/g, $("#trick_pictures").data("index")));

        $("#trick_pictures").data("index", parseInt($("#trick_pictures").data("index")) + 1);
    });

    $("body").on("click", ".remove-picture", function() {
        $($(this).data("target")).remove();
    });

})