<div>

    <ul id="avatar-gallery" class="avatar-gallery">

    </ul>

</div>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "library/avatarsApi.php",
            method: "GET",
            success: function(data) {
                let gallery = JSON.parse(data);
                console.log(gallery);
                for (let avatar of gallery) {
                    $("#avatar-gallery").append(`<li><img src="${avatar.photo}" alt="avatar" class="gallery-image" width="100" height="100"></li>`);
                    $(`img[src="${avatar.photo}"]`).click(function(event) {
                        //update the src of the avatar foto
                        // $(event.target).toggleClass("selected-image");
                        // $("#avatar-Photo").val(avatar.photo);
                    })
                }
            }
        })
    })
</script>