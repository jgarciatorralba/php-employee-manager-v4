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

    filtering: true,
    inserting: true,
    editing: false,
    sorting: true,
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
        insertItem: $.noop,
        updateItem: $.noop,
        deleteItem: $.noop
    },

    rowClick: function (args) {
        // console.log(args.item.id);
        $path = `employee.php?id=${args.item.id}`;
        location.href = $path;
    },

    fields: [{
            name: "id",
            type: "number",
            title: "id",
            width: 30,
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
            width: 60
        },
        {
            name: "phoneNumber",
            type: "text",
            title: "Phone Number",
            width: 80
        },
        {
            type: "control"
        }
    ]
});