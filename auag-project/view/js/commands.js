
$(document).ready(function () {

    var actions;

    $("#actions").load("/auag-project/view/ajax/manage_actions.php?requestType=" + 5,
            function (response, status, xhr) {
                if (status == "error") {

                }
                actions = response;

                $("#grid").shieldGrid({
                    dataSource: {
                        remote: {
                            read: {
                                url: "/auag-project/view/ajax/manage_commands.php?requestType=" + 1,
                                dataType: "json"
                            },
                            modify: {
                                create: {
                                    url: "/auag-project/view/ajax/manage_commands.php?requestType=" + 3,
                                    type: "get",
                                    dataType: "json",
                                    data: function (edited) {
                                        
                                        return {
                                            Name: edited[0].data.Name,
                                            Description: edited[0].data.Description,
                                            Action: edited[0].data.Action
                                        };
                                    }
                                },
                                update: {
                                    url: "/auag-project/view/ajax/manage_commands.php?requestType=" + 2,
                                    type: "get",
                                    dataType: "json",
                                    data: function (edited) {
                                        
                                        return {
                                            ID: edited[0].data.ID,
                                            Name: edited[0].data.Name,
                                            Description: edited[0].data.Description,
                                            Action: edited[0].data.Action
                                        };
                                    }
                                },
                                remove: {
                                    url: "/auag-project/view/ajax/manage_commands.php?requestType=" + 4,
                                    type: "get",
                                    data: function (removed) {
                                        return {ID: removed[0].data.ID};
                                    }
                                }
                            }
                        },
                        schema: {
                            fields: {
                                ID: {path: "cmd_id", type: Number},
                                Name: {path: "cmd_keyword", type: String},
                                Description: {path: "cmd_description", type: String},
                                Action: {path: "cmd_actionname", type: String}
                            }
                        }
                    },
                    sorting: {
                        multiple: true
                    },
                    rowHover: false,
                    columns: [
                        {field: "Name", title: "Command name", width: "50px"},
                        {field: "Description", title: "Command description", width: "80px"},
                        {field: "Action", title: "Action", width: "80px", editor: myCustomEditor},
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
                                    return "Delete command: '" + item.Name + "'?";
                                }
                            }
                        }
                    },
                    toolbar: [
                        {
                            buttons: [
                                {commandName: "insert", caption: "New command"}
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
                                    data: actions
                                },
                                value: !item["Action"] ? null : item["Action"].toString()
                            }).swidget().focus();
                }
            });


});