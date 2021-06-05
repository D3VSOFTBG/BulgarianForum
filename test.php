<style>
nav {
    overflow: hidden;
    background-color: #333;
}

nav a {
    float: left;
    display: block;
    color: #fff;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

nav a:hover {
    background-color: #ddd;
    color: black;
}

nav a.active {
    background-color: #04AA6D;
    color: white;
}

nav .icon {
    display: none;
}

@media screen and (max-width: 600px) {
    nav a:not(:first-child) {
        display: none;
    }

    nav a.icon {
        float: right;
        display: block;
    }
}

@media screen and (max-width: 600px) {
    nav.responsive {
        position: relative;
    }

    nav.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
    }

    nav.responsive a {
        float: none;
        display: block;
        text-align: left;
    }
}
</style>
<nav>
    <a href="auth/register.html">Регистрация</a>
    <a href="auth/login.html">Вход</a>
    <a href="#">Търси</a>
    <img src="<?php echo $url; ?>/assets/images/menu.png" alt="" srcset="">
</nav>