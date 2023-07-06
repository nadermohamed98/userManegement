<?php
include "../inc/inc.php";
if($Logged_role == 1){
    include "../inc/menu.php"; }
else
    include "../inc/user_menu.php";


if(isset($_GET['id']) && !empty($_GET['id'])){
    $EditedID = $_GET['id'];
    $SelectQuery = "SELECT * FROM users WHERE id=$EditedID AND deleted_at IS NULL";
    
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
    $img = "";

    if(isset($_FILES['img'])){
        $image_tmp_name = $_FILES['img']['tmp_name'];
        $imageExtention = explode('.', $_FILES['img']['name']);
        $img = date("Ymd") . rand(10000000, 99999999999) . '.' . end($imageExtention);

        $folder = "/imgs/" . $img;
        move_uploaded_file($image_tmp_name, dirname(__DIR__) . $folder);
    }

    $updateQuery = "UPDATE users SET `name`='$name',`password`='$passQuery', `img`='$img' WHERE id=$EditedID;";
    if(mysqli_query($con,$updateQuery)){
        echo '<div class="alert alert-success text-center">user Edited Successfully</div>';
        header("refresh:1;url=profile.php?id=".$EditedID."");
    }else{
        echo '<div class="alert alert-danger text-center">Error !!</div>';
    }
}
?>
<html lang="en">
    <?php
    ?>
    <body>
        <div class="container">
            <hr>
            <div class="well text-center row">
                <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <a href="../imgs/<?= $Logged_img; ?>" target="blank"><img src="../imgs/<?= $Logged_img; ?>" style="width:150px; border-radius: 200px"/></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-5" for=""> </label>
                        <div class="col-lg-4 float-inp">
                            <input type="file" name="img" id="img">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-lg-4">Name </label>
                        <div class="col-lg-5">
                            <input value="<?= $row_name; ?>" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-lg-4">Password </label>
                        <div class="col-lg-5">
                            <input name="password" type="text" class="form-control">
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
    </body>
</html>