/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function upTime(countTo) {
  now = new Date();
  if (countTo === 0){
      countTo = new Date();
      document.getElementById('serverStatusIcon').innerHTML = 
              "<i class=\"fa fa-cog fa-spin fa-2x fa-fw\"></i>"+
                            "<span class=\"sr-only\">Running</span>";
  }
  difference = (now-countTo);

  days=Math.floor(difference/(60*60*1000*24)*1);
  hours=Math.floor((difference%(60*60*1000*24))/(60*60*1000)*1);
  mins=Math.floor(((difference%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);
  secs=Math.floor((((difference%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);

  var timeUp = "";
  if (days === 0){
      timeUp = hours+" hrs "+mins+" min "+secs+" sec";
      document.getElementById('labeltimer').innerHTML = timeUp;
  } else {
      timeUp = days +" day(s) "+hours+" hrs "+mins+" min "+secs+" sec";
      document.getElementById('labeltimer').innerHTML = timeUp;
  }

  clearTimeout(upTime.to);
  upTime.to=setTimeout(function(){ upTime(countTo); },1000);
}

