<?php
$conn = mysqli_connect("localhost", "root", "", "hospitaldb");
if (!$conn) die("Connection Failed: " . mysqli_connect_error());

if (isset($_POST['submit'])) {
    $pname            = mysqli_real_escape_string($conn, $_POST['pname']);
    $age              = (int)$_POST['age'];
    $gender           = mysqli_real_escape_string($conn, $_POST['gender']);
    $disease          = mysqli_real_escape_string($conn, $_POST['disease']);
    $doctor           = mysqli_real_escape_string($conn, $_POST['doctor']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $stage            = mysqli_real_escape_string($conn, $_POST['stage'] ?? 'Admitted');

    $sql = "INSERT INTO patient(pname, age, gender, disease, doctor, appointment_date, stage)
            VALUES('$pname', '$age', '$gender', '$disease', '$doctor', '$appointment_date', '$stage')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?status=inserted");
    } else {
        header("Location: index.php?status=error");
    }
    exit();
}
mysqli_close($conn);
?>