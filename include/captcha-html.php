<table class="border-none" style="width: fit-content;">
    <tr>
        <td class="border-none">
            <img class="captcha" src="<?php echo "$url/include/captcha.php" ?>" alt="CAPTCHA IMAGE">
        </td>
        <td class="border-none">
            <strong class="refresh-captcha">&#8635;</strong>
        </td>
    </tr>
</table>
<label for="captcha">Капча</label>
<?php
    if(!empty($captcha_err)){
        echo '<br /><span class="error">'.$captcha_err.'</span>';
    }
?>
<br />
<input name="captcha" type="text" placeholder="Моля препишете буквите" pattern="[A-Z]{6}" required />
<script>
    var refreshButton = document.querySelector(".refresh-captcha");
    refreshButton.onclick = function () {
        document.querySelector(".captcha").src = '<?php echo "$url/include/captcha.php?" ?>' + Date.now();
    }
</script>