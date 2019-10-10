//Change input file
$("body").on("change", ".img-upload", function () {
    var preview = $(".picture-preview[data-input='"+$(this).attr("id")+"']");
    console.log(preview)
    console.log(".picture-preview[data-input='"+$(this).attr("id")+"']")
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.html(`<img src="${e.target.result}" />`);
        }

        reader.readAsDataURL(this.files[0]);
    }
})