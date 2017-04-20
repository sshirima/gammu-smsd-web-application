/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var serverIsRunning = 0;
var isCheckingModem = 0;
var isCheckingSmsd = 0;

function upTime(countTo) {

    now = new Date();
    if (countTo === 0) {
        countTo = new Date();
        $("#serverStatus").text("Running");

        document.getElementById('serverStatusIcon').innerHTML =
                "<i class=\"fa fa-cog fa-spin fa-2x fa-fw\"></i>" +
                "<span class=\"sr-only\">Running</span>";
    }

    //Check and Update phone status 
    if (isCheckingModem == 0){
        isCheckingModem =1;
        $("#modemStatus").load("/auag-project/view/ajax/manage_system.php?REQUEST_TYPE="+1,
                function (response, status, xhr){
                    if (status == "error"){
                        
                    }
                    $("#modemStatus").html(response); 
                    isCheckingModem =0;
                });
    }
    
    
    //Check and update Smsd status
    if (isCheckingSmsd == 0){
        isCheckingSmsd = 1;
        $("#smsdStatus").load("/auag-project/view/ajax/manage_system.php?REQUEST_TYPE="+2,
                function (response, status, xhr){
                    if (status == "error"){
                        
                    }  
                    $("#smsdStatus").html(response);
                    isCheckingSmsd = 0;
                });
    }
    
    
    if (serverIsRunning == 0){
        
        //Check and process SMSs
        serverIsRunning = 1;
        $("#msgprocessStatus").load("/auag-project/view/ajax/manage_system.php?REQUEST_TYPE="+3,
        function (response, status, xhr){
            
            if (status == "error"){
                 $("#msgprocessStatus").html("Error running the server");
            } 
            
            if (response == 0){
                $("#msgprocessStatus").html("Proccessing SMS");
            }
            serverIsRunning = 0;
        });
        
    }
   
    
    difference = (now - countTo);

    days = Math.floor(difference / (60 * 60 * 1000 * 24) * 1);
    hours = Math.floor((difference % (60 * 60 * 1000 * 24)) / (60 * 60 * 1000) * 1);
    mins = Math.floor(((difference % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) / (60 * 1000) * 1);
    secs = Math.floor((((difference % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) % (60 * 1000)) / 1000 * 1);

    var timeUp = "";
    if (days === 0) {
        timeUp = hours + " hrs " + mins + " min " + secs + " sec";
        document.getElementById('labeltimer').innerHTML = timeUp;
    } else {
        timeUp = days + " day(s) " + hours + " hrs " + mins + " min " + secs + " sec";
        document.getElementById('labeltimer').innerHTML = timeUp;
    }

    clearTimeout(upTime.to);
    upTime.to = setTimeout(function () {
        upTime(countTo);
    }, 1000);
}

$(document).ready(function () {
    
    //Proccess unprocessed smses
    $("#runServer").click(function () {
        // Start server up time 
        upTime(0);

    });

});

