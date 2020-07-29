const gender = [{
        Name: 'Male',
        Id: 'man'
    },
    {
        Name: 'Female',
        Id: 'woman'
    }
];


$("#jsGrid").jsGrid({
    width: "100%",

    filtering: false,
    inserting: true,
    editing: false,
    sorting: false,
    paging: true,
    pageSize: 5,
    pageButtonCount: 3,
    autoload: true,
    confirmDeleting: true,
    deleteConfirm: "Are you sure?",

    pageSize: 15,
    pageButtonCount: 5,

    align: "center",

    controller: {
        loadData: function () {
            const d = $.Deferred();

            $.ajax('library/employeeController.php').done(response => {
                d.resolve(response);
            });

            return d.promise();
        },
        insertItem: function (item) {
            console.log(item);
            return $.ajax('library/employeeController.php', {
                method: "POST",
                data: item,
                error: (jqXHR, err) => {
                    console.log(err);
                    if (jqXHR.status == 403) {
                        console.log("handle forbidden error code");
                        alert("You are not authorized to delete this item, check with your manager...");
                    }
                },
                success: (result, status, jqXHR) => {
                    console.log(result);
                }
            })
        },
        deleteItem: function (item) {
            return $.ajax('library/employeeController.php', {
                method: "DELETE",
                data: {
                    id: item.id
                },
                error: (jqXHR, err) => {
                    console.log(err);
                    if (jqXHR.status == 403) {
                        console.log("handle forbidden error code");
                        alert("You are not authorized to delete this item, check with your manager...");
                    }
                },
            })
        }
    },

    rowClick: function (args) {
        location.href = `employee.php?id=${args.item.id}`;
    },

    fields: [{
            name: "id",
            type: "number",
            title: "id",
            width: 40,
            editing: false
        },
        {
            name: "name",
            type: "text",
            title: "Name",
            width: 60
        },
        {
            name: "lastName",
            type: "text",
            title: "Last Name",
            width: 60
        },
        {
            name: "email",
            type: "text",
            title: "Email"
        },
        {
            name: "gender",
            type: "select",
            title: "Gender",
            items: gender,
            valueField: "Id",
            textField: "Name",
            width: 50
        },
        {
            name: "age",
            type: "number",
            title: "Age",
            width: 30,
            valueField: 'age'
        },
        {
            name: "streetAddress",
            type: "text",
            title: "Street",
            width: 30
        },
        {
            name: "city",
            type: "text",
            title: "City",
            width: 70
        },
        {
            name: "state",
            type: "text",
            title: "State",
            width: 30
        },
        {
            name: "postalCode",
            type: "text",
            title: "Postal",
            width: 45
        },
        {
            name: "phoneNumber",
            type: "text",
            title: "Phone Number",
            width: 80
        },
        {
            type: "control",
            editButton: false,
            filtering: false,
            sorting: false
        }
    ]
});