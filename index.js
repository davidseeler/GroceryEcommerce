let $ = function(id){
  return document.getElementById(id);
}

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}
  
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

let contentHeight = $("results").clientHeight;
$("sideBar").style.height = contentHeight + 80;