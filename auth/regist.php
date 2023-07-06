<?php 
include "../inc/inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="../css/regist.css">
</head>
<body>
    <div id="ErrMsg">
        <?php if(isset($_GET['msg'])){ 
            foreach($_GET['msg'] as $msg){?>
                <div><?php echo "- ".$msg; ?></div>
            <?php } ?>
        <?php } ?>
    </div>
    <form id="Register" method="post">
        <h1>Register</h1>
        <fieldset id="inputs">
            <input id="name" name="name" autocomplete="off" type="text" placeholder="name" autofocus required>
            <input id="email" name="email" autocomplete="off" type="text" placeholder="email" required>
            <input id="password" name="password" autocomplete="off" type="password" placeholder="Password" required>
            <select id="role" name="role_id" style="width: -moz-available;" required>
                <?php echo getRoles(); ?>
            </select>
            <br><a href="login.php">Login with your account</a>
        </fieldset>
        <fieldset id="actions">
            <input type="submit" name="submitRigist" id="submit" value="Register">
        </fieldset>
    </form>
</body>
</html>