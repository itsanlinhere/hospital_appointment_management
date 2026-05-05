<?php
// progress.php — included inside section-progress div
// Shows patient admission stage progress cards

$conn = mysqli_connect("localhost", "root", "", "hospitaldb");
if (!$conn) {
    echo "<p style='color:#c0392b;padding:20px'>⚠️ DB connection failed: " . mysqli_connect_error() . "</p>";
    return;
}

$result = mysqli_query($conn, "SELECT * FROM patient ORDER BY id DESC");

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<div class='empty-state'><div class='empty-icon'>📋</div><p>No patients admitted yet.</p></div>";
    mysqli_close($conn);
    return;
}

$stageOrder = ['Admitted' => 1, 'Diagnosed' => 2, 'Treatment' => 3, 'Recovery' => 4, 'Discharged' => 5];
$stageEmoji = ['Admitted' => '🏥', 'Diagnosed' => '🔬', 'Treatment' => '💊', 'Recovery' => '🌿', 'Discharged' => '✅'];
$stageCls   = ['Admitted' => 'admitted', 'Diagnosed' => 'diagnosed', 'Treatment' => 'treatment', 'Recovery' => 'recovery', 'Discharged' => 'discharged'];

while ($row = mysqli_fetch_assoc($result)) {
    $id      = htmlspecialchars($row['id']);
    $pname   = htmlspecialchars($row['pname']);
    $age     = htmlspecialchars($row['age']);
    $gender  = htmlspecialchars($row['gender']);
    $disease = htmlspecialchars($row['disease']);
    $doctor  = htmlspecialchars($row['doctor']);
    $date    = htmlspecialchars($row['appointment_date']);
    $stage   = htmlspecialchars($row['stage'] ?? 'Admitted');

    $currentStep = $stageOrder[$stage] ?? 1;
    $avatarClass = strtolower($gender) === 'female' ? 'female' : 'male';
    $avatarIcon  = strtolower($gender) === 'female' ? '👩‍⚕️' : '👨‍⚕️';
    $sc = $stageCls[$stage] ?? 'admitted';

    // Build 5 progress segments
    $segs = '';
    for ($s = 1; $s <= 5; $s++) {
        $cls = ($s <= $currentStep) ? 'progress-seg filled' : 'progress-seg';
        if ($s <= $currentStep && $currentStep === 5) $cls .= ' blush'; // discharged = grey-ish
        $segs .= "<div class='$cls'></div>";
    }

    // Stage dots row
    $stageDots = '';
    foreach ($stageOrder as $sname => $snum) {
        $dot_cls = '';
        if ($snum < $currentStep) $dot_cls = 'done';
        elseif ($snum === $currentStep) $dot_cls = 'active';
        $stageDots .= "<div class='stage $dot_cls'>
            <div class='stage-circle'>" . ($snum < $currentStep ? '✓' : $snum) . "</div>
            <div class='stage-label'>{$stageEmoji[$sname]} $sname</div>
          </div>";
    }

    echo "
    <div class='patient-card' data-stage='$stage'>
      <div class='patient-card-top'>
        <div class='patient-avatar $avatarClass'>$avatarIcon</div>
        <div>
          <div class='patient-name'>$pname</div>
          <div class='patient-meta'>#$id &nbsp;·&nbsp; $age yrs &nbsp;·&nbsp; $gender &nbsp;·&nbsp; $doctor</div>
        </div>
        <div class='patient-card-right'>
          <span class='stage-badge $sc'>$stage</span>
          <div style='font-size:0.72rem;color:var(--muted);margin-top:5px'>📅 $date</div>
        </div>
      </div>
      <div class='progress-stages' style='margin-bottom:10px;padding:14px 18px;'>
        $stageDots
      </div>
      <div style='display:flex;align-items:center;justify-content:space-between;'>
        <div style='font-size:0.78rem;color:var(--muted);'>🩺 <strong style='color:var(--mid)'>$disease</strong></div>
        <div style='font-size:0.72rem;color:var(--muted)'>Step $currentStep of 5</div>
      </div>
      <div class='progress-track' style='margin-top:8px'>$segs</div>
    </div>";
}

mysqli_close($conn);
?>
