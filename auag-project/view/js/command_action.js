
$(document).ready(function () {

    var returnColumn;

    $("#membercolumn").load("/auag-project/view/ajax/manage_members.php?requestType=" + 6,
            function (response, status, xhr) {
                if (status == "error") {

                }
                returnColumn = response;

                $("#actionstable").shieldGrid({
                    dataSource: {
                        remote: {
                            read: {
                                url: "/auag-project/view/ajax/manage_actions.php?requestType=" + 1,
                                dataType: "json"
                            },
                            modify: {
                                create: {
                                    url: "/auag-project/view/ajax/manage_actions.php?requestType=" + 3,
                                    type: "get",
                                    dataType: "json",
                                    data: function (edited) {
                                        
                                        return {
                                            Name: edited[0].data.Name,
                                            Description: edited[0].data.Description,
                                            ReturnColumn: edited[0].data.ReturnColumn
                                        };
                                    }
                                },
                                update: {
                                    url: "/auag-project/view/ajax/manage_actions.php?requestType=" + 2,
                                    type: "get",
                                    dataType: "json",
                                    data: function (edited) {
                                        
                                        return {
                                            ID: edited[0].data.ID,
                                            Name: edited[0].data.Name,
                                            Description: edited[0].data.Description,
                                            ReturnColumn: edited[0].data.ReturnColumn
                                        };
                                    }
                                },
                                remove: {
                                    url: "/auag-project/view/ajax/manage_actions.php?requestType=" + 4,
                                    type: "get",
                                    data: function (edited) {
                                        return {ID: edited[0].data.ID};
                                    }
                                }
                            }
                        },
                        schema: {

                            fields: {
                                ID: {path: "action_id", type: String},
                                Name: {path: "action_name", type: String},
                                Description: {path: "action_description", type: String},
                                ReturnColumn: {path: "action_returncolumn", type: String}
                            }
                        }
                    },
                    sorting: {
                        multiple: true
                    },
                    rowHover: false,
                    columns: [
                        {field: "Name", title: "Action name", width: "50px"},
                        {field: "Description", title: "Description", width: "50px"},
                        {field: "ReturnColumn", title: "Return column", width: "80px", editor: myCustomEditor},
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
                        event: "click",
                        type: "row",
                        confirmation: {
                            "delete": {
                                enabled: true,
                                template: function (item) {
                                    return "Are you sure you want to delete '" + item.Name + "'?";
                                }
                            }
                        }
                    },
                    toolbar: [
                        {
                            buttons: [
                                {commandName: "insert", caption: "New action"}
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
                                    data: returnColumn
                                },
                                value: !item["Action"] ? null : item["Action"].toString()
                            }).swidget().focus();
                }

            });


});