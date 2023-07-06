<?php 
include "../inc/inc.php";

if(isset($_GET['EditID']) && !empty($_GET['EditID'])){
    $EditedID = $_GET['EditID'];
    $SelectQuery = "SELECT * FROM users WHERE id=$EditedID AND role_id=2 AND deleted_at IS NULL";
    
    $result = mysqli_query($con,$SelectQuery);
    while($fetch = mysqli_fetch_array($result)){
        $row_name = $fetch['name'];
        $row_email = $fetch['email'];
        $row_password = $fetch['password'];
    }
}

if(isset($_POST['submitData'])){
    $name = stripslashes($_POST['name']);
    $email = stripslashes($_POST['email']);
    $password = md5(stripslashes($_POST['password']));
    $passQuery = (!empty($_POST['password'])) ? $password : $row_password;

    $InsertQuery = "UPDATE users SET `name`='$name',`email`='$email',`password`='$passQuery' WHERE id=$EditedID;";
    if(mysqli_query($con,$InsertQuery)){
        echo '<div class="alert alert-success text-center">user Edited Successfully</div>';
        header("refresh:1;url=users.php");
    }else{
        echo '<div class="alert alert-danger text-center">Error !!</div>';
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit user</title>
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
                                <input type="text" class="form-control"  name="name" id="name" value="<?php echo $row_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="email">email </label>
                            <div class="col-lg-4 float-inp">
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $row_email ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">Password </label>
                            <div class="col-lg-4 float-inp">
                                <input type="password" class="form-control" name="password" id="password">
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