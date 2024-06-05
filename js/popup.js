function openForm() {
    var form = document.getElementById("myForm");
    form.style.display = "block";
    form.style.opacity = 0;
    var opacity = 0;
    var interval = setInterval(function() {
        if (opacity < 1) {
            opacity += 0.1;
            form.style.opacity = opacity;
        } else {
            clearInterval(interval);
        }
    }, 30);
}

function closeForm() {
    var form = document.getElementById("myForm");
    form.style.display = "none";
}