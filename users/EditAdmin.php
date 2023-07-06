<?php 
include "../inc/inc.php";

if(isset($_GET['EditID']) && !empty($_GET['EditID'])){
    $EditedID = $_GET['EditID'];
    $SelectQuery = "SELECT * FROM users WHERE id=$EditedID AND role_id=1 AND deleted_at IS NULL";
    
    $result = mysqli_query($con,$SelectQuery);
    while($fetch = mysqli_fetch_array($result)){
        $row_name = $fetch['name'];
        $row_email = $fetch['email'];
        $row_password = $fetch['password'];
        $row_role_id = $fetch['role_id'];
    }
}

if(isset($_POST['submitData'])){
    $name = stripslashes($_POST['name']);
    $email = stripslashes($_POST['email']);
    $role_id = stripslashes($_POST['role_id']);
    $password = md5(stripslashes($_POST['password']));
    $passQuery = (!empty($_POST['password'])) ? $password : $row_password;

    if(empty($_POST['password'])){$passSkip=true;}else{$passSkip=false;}
    $validator = validate($_POST, $passSkip);

    if(count($validator) == 0){
        $InsertQuery = "UPDATE users SET `name`='$name',`email`='$email',`password`='$passQuery', `role_id`='$role_id' WHERE id=$EditedID;";
        if(mysqli_query($con,$InsertQuery)){
            echo '<div class="alert alert-success text-center">Admin Edited Successfully</div>';
            header("refresh:1;url=admins.php");
        }else{
            echo '<div class="alert alert-danger text-center">Error !!</div>';
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
    <title>Add New Admin</title>
</head>
    <body>
        <?php 
            include "../inc/menu.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <a href="admins.php" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                    <hr>
                    <form method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="name">Name </label>
                            <div class="col-lg-4 float-inp">
                                <input type="text" class="form-control"  name="name" id="name" value="<?= $row_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="email">User Name </label>
                            <div class="col-lg-4 float-inp">
                                <input type="text" class="form-control" name="email" id="email" value="<?= $row_email ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">Password </label>
                            <div class="col-lg-4 float-inp">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="role">Role </label>
                            <div class="col-lg-4 float-inp">
                                <select name="role_id" id="role_id" class="form-control" require>
                                    <?= getRoles($row_role_id) ?>
                                </select>
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