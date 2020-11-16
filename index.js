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

function addItem(){
  $("quantity").value = parseInt($("quantity").value) + 1;

  originalPrice = parseFloat($("originalPrice").value).toFixed(2);

  let total = originalPrice * parseInt($("quantity").value);
  total = total.toFixed(2);

  $("purchasePrice1").innerHTML = "$" + total;
  $("purchasePrice2").innerHTML = "$" + total;
  $("purchasePrice3").innerHTML = "$" + total;
}

function subtractItem(){
  if ($("quantity").value != 1){
    $("quantity").value = parseInt($("quantity").value) - 1;
  }

  let total = originalPrice * parseInt($("quantity").value);
  total = total.toFixed(2);

  $("purchasePrice1").innerHTML = "$" + total;
  $("purchasePrice2").innerHTML = "$" + total;
  $("purchasePrice3").innerHTML = "$" + total;
}