<?php
$conn = new mysqli('localhost','asib','','hr_system');
if ($conn->connect_errno) {
echo "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT name,surname FROM employee";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<iframe>
<h4>Select employee from the given list</h4>
<?php
echo "<select name='employee'>";
while ($row = $res->fetch_assoc()){
    $em = $row['id_employee'];
    $nome = $row['name'];
    $surname = $row['surname'];
    echo "<option value = '$em'>";
    echo $nome . " " . $surname;
    echo "</option>";
}
echo "</select>";
?>
</iframe>
</body>
</html>