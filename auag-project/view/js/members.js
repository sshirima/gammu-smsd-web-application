
$(document).ready(function () {

    $("#memberstable").shieldGrid({
        dataSource: {
            remote: {
                read: {
                    url:  "/auag-project/view/ajax/manage_members.php?requestType="+1,
                    dataType: "json"
                },
                modify: {
                    create: {
                        url: "/auag-project/view/ajax/manage_members.php?requestType="+1,
                        type: "get",
                        dataType: "json",
                        data: function (edited) {
                            var date = edited[0].data.BirthDate ? edited[0].data.BirthDate.toJSON() : new Date().toJSON();
                            return {
                                Firstname: edited[0].data.Firstname,
                                Lastname: edited[0].data.Lastname,
                                PhoneNumber: edited[0].data.PhoneNumber,
                                Shares: edited[0].data.Shares,
                                PendingJamii: edited[0].data.PendingJamii,
                                PendingFine: edited[0].data.PendingFine,
                                NOR_Date: edited[0].data.NOR_Date
                            };
                        }
                    },
                    update: {
                        url:  "/auag-project/view/ajax/manage_members.php?requestType="+2,
                        type: "get",
                        dataType: "json",
                        data: function (edited) {
                            var date = edited[0].data.BirthDate ? edited[0].data.BirthDate.toJSON() : new Date().toJSON();
                            return {
                                ID: edited[0].data.ID,
                                Firstname: edited[0].data.Firstname,
                                Lastname: edited[0].data.Lastname,
                                PhoneNumber: edited[0].data.PhoneNumber,
                                Shares: edited[0].data.Shares,
                                PendingJamii: edited[0].data.PendingJamii,
                                PendingFine: edited[0].data.PendingFine,
                                NOR_Date: edited[0].data.NOR_Date
                            };
                        }
                    },
                    remove: {
                        url:  "/auag-project/view/ajax/manage_members.php?requestType="+1,
                        type: "get",
                        data: function (removed) {
                            return {ID: removed[0].data.ID};
                        }
                    }
                }
            },
            schema: {

                fields: {
                    ID: {path: "memberID", type: Number},
                    Firstname: {path: "Firstname", type: String},
                    Lastname: {path: "Lastname", type: String},
                    PhoneNumber: {path: "phonenumber", type: String},
                    Shares: {path: "shares", type: String},
                    PendingJamii: {path: "pending_jamii", type: String},
                    PendingFine: {path: "pending_fines", type: String},
                    NOR_Date: {path: "NOR_date", type: String}
                }
            }
        },
        sorting: {
            multiple: true
        },
        rowHover: false,
        columns: [
            {field: "Firstname", title: "Firstname", width: "50px"},
            {field: "Lastname", title: "Lastname", width: "50px"},
            {field: "PhoneNumber", title: "Phonenumber", width: "80px"},
            {field: "Shares", title: "Shares", width: "50px"},
            {field: "PendingJamii", title: "Pending Jamii", width: "80px"},
            {field: "PendingFine", title: "Pending Fines", width: "80px"},
            {field: "NOR_Date", title: "NOR date", width: "80px"},
            {
                width: "104px",
                title: "Edit/Delete command",
                buttons: [
                    {commandName: "edit", caption: "Edit"},
                    {commandName: "delete", caption: "Delete"}
                ]
            }
        ],
        editing: {
            enabled: true,
            event:"click",
            type: "row",
            confirmation: {
                "delete": {
                    enabled: true,
                    template: function (item) {
                        return "Are you sure you want to delete '" + item.Firstname + "'?";
                    }
                }
            }
        },
        toolbar: [
            {
                buttons: [
                    {commandName: "insert", caption: "New member"}
                ],
                position: "top"
            }
        ],
        events:
                {
                    getCustomEditorValue: function (e) {
                        e.value = $("#dropdown").swidget().value();
                        $("#dropdown").swidget().destroy();
                    }
                }

    });

    function myCustomEditor(cell, item) {
        $('<div id="dropdown"/>')
                .appendTo(cell)
                .shieldDropDown({
                    dataSource: {
                        data: ["motorbike", "car", "truck"]
                    },
                    value: !item["transport"] ? null : item["transport"].toString()
                }).swidget().focus();
    }
});