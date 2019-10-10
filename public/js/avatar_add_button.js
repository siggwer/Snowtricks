//Change input file
$("body").on("change", ".img-avatar-upload", function () {
    var preview = $(".picture-avatar-preview[data-input='"+$(this).attr("id")+"']");
    console.log(preview)
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.html(`<img src="${e.target.result}" />`);
        }

        reader.readAsDataURL(this.files[0]);
    }
})