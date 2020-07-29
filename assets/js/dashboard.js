$("#jsGrid").jsGrid({
    width: "100%",

    filtering: false,
    inserting: true,
    editing: false,
    sorting: true,
    paging: true,
    autoload: true,
    confirmDeleting: true,
    deleteConfirm: "Are you sure?",

    pageSize: 10,
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
            return $.ajax('library/employeeController.php', {
                method: "POST",
                data: item,
                error: (jqXHR, err) => {
                    console.log(err);
                    if (jqXHR.status == 403) {
                        console.log("handle forbidden error code");
                        alert("You are not authorized to delete this item, check with your manager...");
                    }
                }
            });
        },
        deleteItem: function (item) {
            return $.ajax('library/employeeController.php', {
                method: "DELETE",
                data: {
                    id: item.id
                },
                error: (jqXHR, err) => {
                    if (jqXHR.status == 403) {
                        console.log("handle forbidden error code");
                        alert("You are not authorized to delete this item, check with your manager...");
                    }
                },
            });
        }
    },

    rowClick: function (args) {
        location.href = `employee.php?id=${args.item.id}`;
    },

    fields: [
        { name: "id", type: "number", visible: false },
        { name: "name", type: "text", title: "Name", width: 80 },
        { name: "email", type: "text", title: "Email" },
        { name: "age", type: "number", title: "Age", width: 40 },
        { name: "streetAddress", type: "text", title: "Street No.", width: 80 },
        { name: "city", type: "text", title: "City", },
        { name: "state", type: "text", title: "State", width: 40 },
        { name: "postalCode", type: "text", title: "Postal Code", width: 80 },
        { name: "phoneNumber", type: "text", title: "Phone Number", },
        { type: "control", editButton: false }
    ]
});