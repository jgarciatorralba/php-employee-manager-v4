const log = console.log;

$.ajax({
    url: 'library/employeeController.php',
    method: 'GET',
    data: { employee: $_GET('id') }
}).done(response => fillForm(response));

function $_GET(key) {
    const url = new URL(window.location.href);
    return url.searchParams.get(key);
}

function fillForm(employee) {
    for (const [key, value] of Object.entries(employee)) {
        $(`[name=${key}]`).val(value);
    }
}

$("#avatar-image").click((e) => {
    $("#avatar-gallery").toggle();
});