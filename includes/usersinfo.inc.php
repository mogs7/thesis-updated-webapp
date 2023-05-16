<?php
require_once 'dbh.inc.php';

$sql = "SELECT * FROM usersinfo";

session_start();
$ID = $_SESSION["edit-id"];
$ID_delete = $_SESSION["Delete-id"];
if (isset($_POST["Edit"])) {
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $phoneNumber = $_POST["phone-number"];

    $sql = "UPDATE usersinfo SET 
            firstName = '$firstName', 
            lastName = '$lastName', 
            usersPnumber = '$phoneNumber'
            WHERE usersID = '$ID'";

            $result = mysqli_query($conn, $sql);
            if($result){
                header("Location: ../usersinfo.php?error=none");
            }
}else{
    $sql = "DELETE FROM usersinfo WHERE usersID = '$ID_delete';";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: ../usersinfo.php?error=none");
    }
}



// Execute the query
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

// Fetch data and store it in an array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

