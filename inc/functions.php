<?php
include_once "inc.php";

function getRoles($row_id = null){
    global $con;
    $options = '<option value="" disabled selected>choose role</option>';
    $query = "SELECT * FROM roles WHERE deleted_at IS NULL";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
        while($fetch = mysqli_fetch_array($result)){
            if($row_id == $fetch['id'])
                $options .= "<option value='".$fetch['id']."' selected>".$fetch['role']."</option>";
            else
                $options .= "<option value='".$fetch['id']."'>".$fetch['role']."</option>";
        }
    }
    return $options;
}

function checkEmailUnique($email){
    global $con;
    $query = "SELECT * FROM users WHERE email='$email' AND deleted_at IS NULL";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
        return false;
    }
    return true;
}

function validate($request, $passSkip = false){
    $Errors=[];
    $email = $request["email"];
    $password = $request["password"];
    $role_id = $request["role_id"];
    $name = $request["name"];
    if ($name == '') {
        $Errors['name'] = "name is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $Errors['email'] = "Invalid email format";
    }
    if (strlen($password) < 8 && $passSkip == false) {
        $Errors['password'] = "Password must be bigger than 8 characters";
    }
    if ($role_id == '') {
        $Errors['role_id'] = "Role is required";
    }
    return $Errors;
}

function login(){
    global $con;
    $data=[];
    
    $userDataQuery = "SELECT * FROM users WHERE `email`='$_SESSION[user]' AND `password`='$_SESSION[pass]' AND deleted_at IS NULL";
    $userData = mysqli_query($con,$userDataQuery);

    if(mysqli_num_rows($userData) == 0){
        $data['errors'][] = "Wrong Email Or password :(";
    }else{
        $data['data'] = mysqli_fetch_array($userData);
    }

    return $data;
}


?>