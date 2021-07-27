var refreshButton = document.querySelector(".refresh-captcha");
refreshButton.onclick = function () {
    document.querySelector(".captcha").src = 'captcha.php?' + Date.now();
}