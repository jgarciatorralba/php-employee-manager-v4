
const gender = [
    { Name: 'Male', Id: 'man' },
    { Name: 'Female', Id: 'woman' }
];


$("#jsGrid").jsGrid({
    width: "100%",
    height: "500px",

    inserting: true,
    editing: true,
    sorting: true,
    paging: true,
    autoload: true,

    controller: {
        loadData: function () {
            const d = $.Deferred();
            $.ajax('../src/library/employeeController.php').done(d.resolve);
            return d.promise();
        }
    },

    fields: [
        { name: "id", type: "number", editing: false },
        { name: "name", type: "text" },
        { name: "lastName", type: "text" },
        { name: "email", type: "text" },
        { name: "gender", type: "select", items: gender, valueField: "Id", textField: "Name" },
        { name: "age", type: "number", valueField: 'age' },
        { name: "streetAddress", type: "text" },
        { name: "city", type: "text" },
        { name: "state", type: "text" },
        { name: "postalCode", type: "text" },
        { name: "phoneNumber", type: "text" },
        { type: "control" }
    ]
});