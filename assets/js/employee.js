$.ajax({
    url: 'index.php?controller=employee&action=getEmployeeAJAX',
    method: 'GET',
    data: { empID: $_GET('id') }
}).done(response => fillForm(JSON.parse(response)));

function $_GET(key) {
    const url = new URL(window.location.href);
    return url.searchParams.get(key);
}

function fillForm(employee) {
    for (const [key, value] of Object.entries(employee)) {
        $(`[name=${key}]`).val(value);
    }
    if (employee.hasOwnProperty('avatar') && employee.avatar) {
        $('#avatar-image').attr('src', employee.avatar);
    }
}

//By default the gallery must remain hidden 
$("#avatar-gallery").hide();
//We will only show it when we click on the avatar image
$("#avatar-image").click((e) => {
    $("#avatar-gallery").toggle();
});


if ($_GET('success') === 'true') {
    $('.alert').text(' User updated successfuly.')
        .fadeIn(800)
        .delay(4000)
        .fadeOut(800);
}
