<?php
include "../inc/inc.php";

$limit = 5;
$start = 0;
if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page']!=1) {
    $n_start = $n_start + ($limit*($_GET['page']-1));
    $start = $start + $n_start;
}else{
    $_GET['page'] = 1;
}

$numPagesQuery = "SELECT * FROM users WHERE deleted_at IS NULL AND role_id=2 $sqlFilter;";
$numPagesQueryresult = mysqli_query($con, $numPagesQuery);
$numPages = mysqli_num_rows($numPagesQueryresult);

$realnumPages = 0;
$realnumPages = (int)ceil($numPages/$limit);

$SelectQuery = "SELECT * FROM users WHERE deleted_at IS NULL AND role_id=2 ORDER BY id DESC LIMIT $start,$limit;";
$result = mysqli_query($con,$SelectQuery);

$PageName = "users.php?";
$pagination = "<div style='background-color:blanchedalmond;height:23px;border:1px solid black'>";

if(($numPages / $limit) > 1){
    if(1 < (int)$_GET['page']){
        $pagination .= " <span style='border:1px solid;margin:5px;border-radius:3px;padding:0px 5px'> <a href='".$PageName."&page=".($_GET['page']-1)."'><i class='fa fa-arrow-left'></i></a> </span> ";
    }
    
        for($i=1 ; $i<=$realnumPages ; $i++){
        if($_GET['page'] == $i)
            $pagination .= ' <a href="'.$PageName.'&page='.$i.'" style="color:red">'.$i.'</a> ';
        else
            $pagination .= ' <a href="'.$PageName.'&page='.$i.'">'.$i.'</a> ';
    }
    
    if($realnumPages > (int)$_GET['page']){
        $pagination .= " <span style='border:1px solid;margin:5px;border-radius:3px;padding:0px 5px'> <a href='".$PageName."&page=".($_GET['page']+1)."'><i class='fa fa-arrow-right'></i></a> </span> ";
    }
}
$pagination .= " </div>";

if(isset($_GET['delID']) && !empty($_GET['delID'])){
    $DeleteDate = date('Y-m-d H:i:s');
    $DeletedID = $_GET['delID'];
    $DeleteQuery = "UPDATE users SET deleted_at='$DeleteDate' WHERE id=$DeletedID AND role_id=2";
    if(mysqli_query($con,$DeleteQuery)){
        echo '<div class="alert alert-success text-center"> User Deleted Successfully </div>';
        header("refresh:1;url=users.php");
    }else{
        echo '<div class="alert alert-danger text-center"> Error !! </div>';
    }
}

?>
<html>
    <head>
        <title> Users </title>
    </head>
    <body>
        <?php 
            include "../inc/menu.php";
        ?>
        <div class="container">
            <br>
            <a href="addUsers.php" class="btn btn-success">Add New User</a><br>
            <hr>
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">serial</th>
                                                    <th class="text-center">name</th>
                                                    <th class="text-center">E-mail</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    while($fetch = mysqli_fetch_array($result)){
                                                        echo '<tr class="even gradeC">
                                                            <td class="text-center">'.$fetch['id'].'</td>
                                                            <td class="text-center">'.$fetch['name'].'</td>
                                                            <td class="text-center">'.$fetch['email'].'</td>
                                                            <td class="text-center">
                                                                <a href="?delID='.$fetch['id'].'" onclick="return confirm(\'Are U Sure ?\')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                                <a href="editUsers.php?EditID='.$fetch['id'].'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                            </td>
                                                        </tr>';
                                                    }        
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="col-lg-12 text-center">
                                            <?php echo $pagination; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>