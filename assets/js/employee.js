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

$(function () {
    if ($_GET('success') === 'true') {
        $('.alert').text(' User updated successfuly.')
            .fadeIn(800)
            .delay(4000)
            .fadeOut(800);
    }
});
