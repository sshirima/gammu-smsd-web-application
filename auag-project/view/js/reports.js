
$(document).ready(function () {

    $("#userreporttable").shieldGrid({
        dataSource: {
            remote: {
                read: {
                    url:  "/auag-project/view/ajax/manage_reports.php?requestType="+1,
                    dataType: "json"
                }
            },
            schema: {

                fields: {
                    Firstname: {path: "FirstName", type: Number},
                    Phonenumber: {path: "phonenumber", type: String},
                    SentSMS: {path: "SentSMS", type: String},
                    ReceivedSMS: {path: "ReceivedSMS", type: String}
                }
            }
        },
        sorting: {
            multiple: true
        },
        rowHover: false,
        columns: [
            {field: "Firstname", title: "Member name", width: "50px"},
            {field: "Phonenumber", title: "Phonenumber", width: "50px"},
            {field: "ReceivedSMS", title: "SMS received", width: "50px"},
            {field: "SentSMS", title: "SMS sent", width: "50px"}
            
        ]

    });

});