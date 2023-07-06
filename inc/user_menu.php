<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700">
    <link rel="stylesheet" href="../assets/Layout/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../assets/Layout/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="../assets/Layout/css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="../assets/Layout/css/nouislider.min.css" />
    <link rel="stylesheet" href="../assets/Layout/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/Layout/css/style.css" />
    <link rel="stylesheet" href="../assets/Layout/css/backend1.css" />

</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="../Dashboard/home.php"><i class="fa fa-home"></i> Users Manegement</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
            
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <?php echo $Logged_name ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../Dashboard/profile.php?id=<?= $Logged_id; ?>"><i class="fa fa-user-circle-o"></i> profile</a></li>
                        <li><a href="../auth/logout.php"><i class="fa fa-lock"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <script src="../assets/Layout/js/jquery.min.js"></script>
    <script src="../assets/Layout/js/bootstrap.min.js"></script>
    <script src="../assets/Layout/js/slick.min.js"></script>
    <script src="../assets/Layout/js/nouislider.min.js"></script>
    <script src="../assets/Layout/js/jquery.zoom.min.js"></script>
    <script src="../assets/Layout/js/main.js"></script>
    <script src="../assets/Layout/js/backend.js"></script>
    
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toLowerCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[0].style.display = "";
                    tr[i].style.display = "";
                } else {
                    tr[0].style.display = "";
                    tr[i].style.display = "none";
                }
            }
        }
    } 
</script>
</body>

</html>