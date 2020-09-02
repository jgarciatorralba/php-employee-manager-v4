$.ajax({
    url: projectURL + 'employee/getEmployeeAJAX/' + getIdFromURL(4),
    method: 'GET'
}).done(response => {
    console.log(JSON.parse(response))
    fillForm(JSON.parse(response))
});

function getIdFromURL(position) {
    const url = window.location.pathname;
    const myArray = url.split("/");
    console.log(myArray);
    return myArray[position];
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

// Animation effect for the success message on submitting form
$('.alert').text('User updated successfully.')
    .fadeIn(800)
    .delay(4000)
    .fadeOut(800);