<?php 
include "../inc/inc.php";

if(isset($_POST['submitData'])){
    $name = stripslashes($_POST['name']);
    $email = stripslashes($_POST['email']);
    $password = md5(stripslashes($_POST['password']));
    $role_id = stripslashes($_POST['role_id']);

    $validator = validate($_POST);
    if(count($validator) == 0){
        if(checkEmailUnique($email)){
            $InsertQuery = "INSERT INTO users (`name`,`email`,`password`,`role_id`) VALUES('$name','$email','$password','$role_id');";
            if(mysqli_query($con,$InsertQuery)){
                echo '<div class="alert alert-success text-center">Users Added Successfully</div>';
                header("refresh:1;url=users.php");
            }else{
                echo '<div class="alert alert-danger text-center">Error !!</div>';
            }
        }else{
            echo '<div class="alert alert-danger text-center">Email Allready Exists</div>';
        }
    }else{
        foreach($validator as $msg){
            echo '<div class="alert alert-danger text-center">'.$msg.'</div>';
        }
    }

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Users</title>
</head>
    <body>
        <?php 
            include "../inc/menu.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <a href="users.php" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                    <hr>
                    <form method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="name">Name </label>
                            <div class="col-lg-4 float-inp">
                                <input value="<?= $_POST['name']; ?>" type="text" class="form-control"  name="name" id="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="email">User Name </label>
                            <div class="col-lg-4 float-inp">
                                <input value="<?= $_POST['email']; ?>" type="text" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">Password </label>
                            <div class="col-lg-4 float-inp">
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="role_id">Role </label>
                            <div class="col-lg-4 float-inp">
                                <select name="role_id" id="role_id" class="form-control"><?= getRoles(2); ?></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for=""> </label>
                            <div class="col-lg-4 float-inp">
                                <input type="submit" class="btn btn-success" value="Save" name="submitData" id="submitData" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>