//function button video
$(function() {

    $(".trick-video").on("click", function() {
        $("#trick_videos").append(($("#trick_videos").data("prototype")).replace(/__name__/g, $("#trick_videos").data("index")));

        $("#trick_videos").data("index", parseInt($("#trick_videos").data("index")) + 1);
    });

    $("body").on("click", ".remove-video", function() {
        $($(this).data("target")).remove();
    });

})