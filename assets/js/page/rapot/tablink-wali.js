// Tab Tugas & Ujian Wali
function openCity(evt, cityName) {
    var i, tabcontent_wali, tablinks_wali;
    tabcontent_wali = document.getElementsByClassName("tabcontent-wali");
    for (i = 0; i < tabcontent_wali.length; i++) {
      tabcontent_wali[i].style.display = "none";
    }
    tablinks_wali = document.getElementsByClassName("tablinks-wali");
    for (i = 0; i < tablinks_wali.length; i++) {
      tablinks_wali[i].className = tablinks_wali[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();