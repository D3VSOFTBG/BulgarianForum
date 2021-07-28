<footer>
    <p class="text-center"><a href="#">BulgarianForum</a> &copy; 2021</p>
    <p style="color: gray;" class="text-center">Дата: (<strong id="date"></strong>)</p>
</footer>

<!--JavaScript-->
<script src="<?php echo $url; ?>/assets/js/date.js"></script>
<script src="<?php echo $url; ?>/assets/js/nav.js"></script>
<?php
    if(str_contains($_SERVER['SCRIPT_NAME'], 'register.php') || str_contains($_SERVER['SCRIPT_NAME'], 'login.php')){
        echo "<script src='$url/assets/js/captcha.js'></script>";
    }
?>
</body>

</html>