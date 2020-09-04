const projectURL = 'http://localhost/employee-management-v4/';

$.get(projectURL + "employee", function (data) {
    if (typeof (JSON.parse(data)) != 'string') {
        $("#jsGrid").jsGrid({
            height: "auto",
            width: '100%',
            filtering: false,
            inserting: true,
            editing: false,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            confirmDeleting: true,
            deleteConfirm: "Do you really want to delete this employee?",

            // data: data,
            data: JSON.parse(data),

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
                        response = JSON.parse(response);
                        // console.log(response);
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

            // Callback function to add a valid "id" before a new employee is inserted
            onItemInserting: function (args) {
                // Check if the email already exists in the DB and if so send alert message.
                let gridData = $("#jsGrid").jsGrid("option", "data");
                for (var i = 0; i < gridData.length; i++) {
                    if (args.item.email === gridData[i].email) {
                        args.cancel = true;
                        alert("Email " + args.item.email + " already exists! Repeated items cannot be inserted.");
                        break;
                    }
                }
                // Add missing "id" for newly inserted employees.
                if (args.item.id === undefined) {
                    $.ajax({
                        url: projectURL + 'employee/getNextIdentifierAJAX'
                    }).done(function (response) {
                        args.item.id = response;
                    });
                }
            },

            fields: [{
                    name: 'id',
                    title: 'Id',
                    visible: false,
                    width: 0
                },
                {
                    name: 'name',
                    type: 'text',
                    title: 'Name',
                    width: 100
                },
                {
                    name: 'email',
                    type: 'text',
                    title: 'Email',
                    width: 200
                },
                {
                    name: 'age',
                    type: 'number',
                    title: 'Age',
                    width: 75
                },
                {
                    name: 'streetAddress',
                    type: 'text',
                    title: 'Street No.',
                    width: 100
                },
                {
                    name: 'city',
                    type: 'text',
                    title: 'City',
                    width: 120
                },
                {
                    name: 'state',
                    type: 'text',
                    title: 'State',
                    width: 70
                },
                {
                    name: 'postalCode',
                    type: 'text',
                    title: 'Postal Code',
                    width: 100
                },
                {
                    name: 'phoneNumber',
                    type: 'text',
                    title: 'Phone Number',
                    width: 140
                },
                {
                    type: 'control',
                    editButton: false,
                    width: 50
                }
            ]
        })
    } else {
        $('.error-jsGrid').text(data)
            .fadeIn(800)
            .delay(4000)
            .fadeOut(800);
    }
});