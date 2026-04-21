<?php
$conn = new mysqli("localhost", "root", "", "health_system");

// Get latest patient
$result = $conn->query("SELECT * FROM patients ORDER BY patient_id DESC LIMIT 1");
$row = $result->fetch_assoc();

$patient_id = $row['patient_id'];

// Assign severity
$severity = "HIGH";

$conn->query("INSERT INTO alerts(patient_id, status) VALUES($patient_id, '$severity')");

echo "<h1 style='color:red;'>🚨 HIGH PRIORITY ALERT SENT</h1>";
?>