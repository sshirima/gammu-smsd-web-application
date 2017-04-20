$(document).ready(function () {
    
    $("#saveMemberData").click(function () {
        
        $("#saveMemberDataReponce").load("/auag-project/view/ajax/manage_members_upload.php");
    });
});
