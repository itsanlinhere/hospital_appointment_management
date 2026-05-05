<?php
$conn = mysqli_connect("localhost", "root", "", "hospitaldb");
if (!$conn) die("Connection Failed: " . mysqli_connect_error());

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = mysqli_query($conn, "SELECT id FROM patient WHERE id = $id");
    if (mysqli_num_rows($result) > 0) {
        if (mysqli_query($conn, "DELETE FROM patient WHERE id = $id")) {
            header("Location: index.php?status=deleted");
        } else {
            header("Location: index.php?status=error");
        }
    } else {
        header("Location: index.php?status=error");
    }
} else {
    header("Location: index.php?status=error");
}
exit();
mysqli_close($conn);
?>