var popup = document.getElementById("popup");
var btn = document.getElementById("popupbutton");
var close = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    popup.style.display = "block";
}

close.onclick = function() {
    popup.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == popup) {
    popup.style.display = "none";
    }
}
