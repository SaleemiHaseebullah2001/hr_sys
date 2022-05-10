<?php
session_start();
$conn = new mysqli('localhost','root','','hr_system');
if ($conn->connect_errno) {
echo "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT id_employee,name,surname FROM employee";
$res = $conn->query($sql);
$sql1 = "SELECT name FROM department";
$res1 = $conn->query($sql1);
//$id_employee = $_POST['id_employee'];
//$sql2 = "SELECT * FROM employee WHERE id_employee = ";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

<!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css" />
    <title>X-Lab</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
    <img src="img/x-lab.png" width="55" height="50" class="d-inline-block align-top">
        X-Lab
    </a>
</nav>
<header>
<p>Welcome to Human Resources Department of <b>X-Lab</b></p>
</header>
<div class="container" style="float: left; width: 50%;">
    <form method="post" action="index.php">
        <div class="row">
            <div class="col" style="text-align: center;">
                <h5>Select employee from the given list</h5>
                <?php
                echo "<select name='employee'>";
                while ($row = $res->fetch_assoc()){
                    $id_em = $row['id_employee'];
                    echo $id_em;
                    $fname = $row['name'];
                    $lname = $row['surname'];
                    echo "<option value = '$id_em' name='id_em'>";
                    echo $fname.  " " . $lname ;
                    echo "</option>";
                }
                echo "</select>";
                ?>
                <div class="form-group"></div>
                    <input type="submit" value="Search" class="btn btn-primary" name="search">
                </div>
                <?php
                if(isset($_POST['search'])){
                    $id_employee = $_POST['employee'];
                    $sql2 = "SELECT * FROM employee WHERE id_employee  = $id_employee ";
                    if( !( $res2 = $conn->query($sql2) ) ){
                        echo "Retrieval of data from Database Failed - # " . mysqli_error($conn);
                    }else{
                        ?>
                    <table class="table" border = 2>
                        <?php
                        if( mysqli_num_rows( $res2 )==0 ){
                            echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                        }else{
                            while( $row = mysqli_fetch_assoc( $res2 ) ){
                            echo "<tr><th scope='row'>Name</th><td>{$row['name']}</td></tr>";
                            echo "<tr><th scope='row'>surname</th><td>{$row['surname']}</td></tr>";
                            echo "<tr><th scope='row'>Gender</th><td>{$row['gender']}</td></tr>";
                            echo "<tr><th scope='row'>Date of birth</th><td>{$row['dob']}</td></tr>";
                            echo "<tr><th scope='row'>Email</th><td>{$row['email']}</td></tr>";
                            echo "<tr><th scope='row'>Number</th><td>{$row['number']}</td></tr>";
                            echo "<tr><th scope='row'>Address</th><td>{$row['address']}</td></tr>";
                            echo "<tr><th scope='row'>City_code</th><td>{$row['city_code']}</td></tr>";
                            echo "<tr><th scope='row'>City</th><td>{$row['city']}</td></tr>";
                            echo "<tr><th scope='row'>Province</th><td>{$row['province']}</td></tr>";
                            echo "<tr><th scope='row'>Designation</th><td>{$row['designation']}</td></tr>";
                            echo "<tr><th scope='row'>Photo</th><td><img src={$row['photo']} width='80' height='80'></td></tr>";
                            echo "<tr><th scope='row'>Department</th><td>{$row['fk_id_department']}</td></tr>";
                            echo "<tr><th scope='row'>Pass Number</th><td>{$row['fk_pass_num']}</td></tr>";
                            }

                        }
                        ?>
                    </table>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </form>
</div>

<div class="container" style="float: right; width: 50%;">
        <div class="row">
            <div class="col" style="text-align: center; padding-top: 63px">
                <h5>Select department from the given list</h5>
                <?php
                    $sql3 = "SELECT * FROM department";
                    if( !( $res3 = $conn->query($sql3) ) ){
                        echo "Retrieval of data from Database Failed - # " . mysqli_error($conn);
                    }else{
                        ?>
                    <table class="table" border = 2>
                    <thead scope = "col">
                        <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Manager</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if( mysqli_num_rows( $res3 )==0 ){
                            echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                        }else{
                            while( $row = mysqli_fetch_assoc( $res3 ) ){
                            $id_em =$row['id_department'];
                            echo "<tr value='$id_em' name='$id_em'>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['fk_id_employee']}</td>
                            </tr>\n";
                            }
                        }
                        ?>
                    </tbody>
                    </table>
                        <?php
                    }
                //}
                ?>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>