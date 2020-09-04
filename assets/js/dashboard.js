const projectURL = 'http://localhost/employee-management-v4/';

$.get(projectURL + "employee", function (data) {
    if (typeof (JSON.parse(data)) != 'string') {
        $("#jsGrid").jsGrid({
            width: '100%',

            filtering: false,
            inserting: true,
            editing: false,
            sorting: true,
            paging: true,
            autoload: true,
            confirmDeleting: true,
            deleteConfirm: 'Are you sure?',

            // data: data,
            data: JSON.parse(data),

            pageSize: 10,
            pageButtonCount: 5,

            align: 'center',

            controller: {
                insertItem: function (item) {
                    return $.ajax({
                        url: projectURL + 'employee/createEmployeeAJAX',
                        method: 'POST',
                        data: item
                    }).done(response => {
                        if (response === "") {
                            return response;
                        } else {
                            $('.error-jsGrid').text(JSON.parse(response))
                                .fadeIn(800)
                                .delay(4000)
                                .fadeOut(800);
                        }
                    }).fail(console.log);
                },
                deleteItem: function (item) {
                    return $.ajax({
                        url: projectURL + 'employee/deleteEmployeeAJAX',
                        method: 'DELETE',
                        data: {
                            id: item.id
                        }
                    }).done(response => {
                        // response = JSON.parse(response);
                        console.log(response);
                        if (typeof (response) == 'string') {
                            $('.error-jsGrid').text(response)
                                .fadeIn(800)
                                .delay(4000)
                                .fadeOut(800);
                        }
                    }).fail(console.log);
                }
            },

            rowClick: function (args) {
                location.href = projectURL + `employee/showEmployeeForm/${args.item.id}`;
            },

            fields: [{
                    name: 'id',
                    type: 'number',
                    visible: false
                },
                {
                    name: 'name',
                    type: 'text',
                    title: 'Name',
                    width: 80
                },
                {
                    name: 'email',
                    type: 'text',
                    title: 'Email'
                },
                {
                    name: 'age',
                    type: 'number',
                    title: 'Age',
                    width: 40
                },
                {
                    name: 'streetAddress',
                    type: 'text',
                    title: 'Street No.',
                    width: 80
                },
                {
                    name: 'city',
                    type: 'text',
                    title: 'City',
                },
                {
                    name: 'state',
                    type: 'text',
                    title: 'State',
                    width: 40
                },
                {
                    name: 'postalCode',
                    type: 'text',
                    title: 'Postal Code',
                    width: 80
                },
                {
                    name: 'phoneNumber',
                    type: 'text',
                    title: 'Phone Number',
                },
                {
                    type: 'control',
                    editButton: false
                }
            ]
        })
    } else {
        // console.log(data)
        $('.error-jsGrid').text(data)
            .fadeIn(800)
            .delay(4000)
            .fadeOut(800);
    }

});