<?php
$conn = new mysqli("localhost", "root", "", "health_system");

echo "<h2>🚑 Emergency Dashboard</h2>";

$result = $conn->query("SELECT * FROM alerts");

while($row = $result->fetch_assoc()) {
    echo "<div style='border:1px solid black; padding:10px; margin:10px;'>";
    echo "Patient ID: " . $row['patient_id'] . "<br>";
    echo "Severity: <b style='color:red'>" . $row['status'] . "</b>";
    echo "</div>";
}
?>