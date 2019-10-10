//function delete button picture on front
$(function() {

    $("body").on("click", ".remove-picture-avatar", function() {
        $($(this).data("target")).remove();
    });

})