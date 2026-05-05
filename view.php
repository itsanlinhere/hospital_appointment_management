<?php
// Included inside index.php <tbody> — use return NOT exit
$conn = mysqli_connect("localhost", "root", "", "hospitaldb");
if (!$conn) {
    echo "<tr><td colspan='9' style='text-align:center;color:#c0392b;padding:30px'>⚠️ DB connection failed: " . mysqli_connect_error() . "</td></tr>";
    return;
}

$result = mysqli_query($conn, "SELECT * FROM patient ORDER BY id DESC");

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<tr><td colspan='9'><div class='empty-state'><div class='empty-icon'>🏥</div><p>No patient records found. Register the first patient!</p></div></td></tr>";
} else {
    $stages = ['Admitted'=>'admitted','Diagnosed'=>'diagnosed','Treatment'=>'treatment','Recovery'=>'recovery','Discharged'=>'discharged'];
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $id      = htmlspecialchars($row['id']);
        $pname   = htmlspecialchars($row['pname']);
        $age     = htmlspecialchars($row['age']);
        $gender  = htmlspecialchars($row['gender']);
        $disease = htmlspecialchars($row['disease']);
        $doctor  = htmlspecialchars($row['doctor']);
        $date    = htmlspecialchars($row['appointment_date']);
        $stage   = htmlspecialchars($row['stage'] ?? 'Admitted');
        $genderClass = strtolower($gender) === 'female' ? 'female' : 'male';
        $genderIcon  = strtolower($gender) === 'female' ? '♀' : '♂';
        $stageCls = $stages[$stage] ?? 'admitted';
        $delay = $i * 40;
        echo "<tr data-id='$id' style='animation-delay:{$delay}ms'>
                <td><span style='color:var(--muted);font-size:0.78rem'>#$id</span></td>
                <td><strong>$pname</strong></td>
                <td>$age</td>
                <td><span class='badge $genderClass'>$genderIcon $gender</span></td>
                <td>$disease</td>
                <td>$doctor</td>
                <td><span class='stage-badge $stageCls'>$stage</span></td>
                <td>$date</td>
                <td><button class='btn-delete' onclick=\"confirmDelete($id, '$pname')\">🗑 Delete</button></td>
              </tr>";
        $i++;
    }
}
mysqli_close($conn);
?>
