<?php
include "../inc/inc.php";
?>
<html lang="en">
    <?php
        if($Logged_role == 1){
            include "../inc/menu.php"; }
        else
            include "../inc/user_menu.php";
    ?>
    <body>
        <div class="container">
            <hr>
            <div class="well text-center">
                <span style="font-size: 80px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">WELLCOME "<?= $Logged_name ?>"</span>
                <hr>
                <span style="font-size: 32px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">To Users Management System</span>
            </div>
        </div>
    </body>
</html>