var keyword = document.getElementById("keyword");
var tombolCari = document.getElementById("tombol-cari");
var container = document.getElementById("container");

keyword.addEventListener("keyup", function () {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // container.innerHTML = xhr.responseText;
      container.innerHTML = keyword.value;
    }
  };

  xhr.open("GET", "../ajax/index2.php?keyword=" + keyword.value, true);
  xhr.send();
});
