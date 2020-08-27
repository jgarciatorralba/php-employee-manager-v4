<div>
    <ul id="avatar-gallery" class="avatar-gallery">
    </ul>
</div>

<script src="node_modules/jquery/dist/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "libs/avatarsApi.php",
            method: "GET",
            success: function(data) {
                let gallery = JSON.parse(data);
                console.log(gallery);
                for (let avatar of gallery) {
                    $("#avatar-gallery").append(`<li><img src="${avatar.photo}" alt="avatar" class="gallery-image rounded border" width="100" height="100"></li>`);
                    $(`img[src="${avatar.photo}"]`).click(function(event) {
                        const image = $(event.target);
                        const url = image.attr('src');
                        $('#avatar-image').attr('src', url);
                        $('#avatarInput').val(url);
                    })
                }
            }
        })
    })
</script>