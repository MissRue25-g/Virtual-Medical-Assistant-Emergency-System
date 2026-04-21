<?php
$conn = new mysqli("localhost", "root", "", "health_system");

$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$symptoms = $_POST['symptoms'] ?? '';

if ($symptoms == '') {
    echo "Please enter symptoms first!";
    exit();
}

// Insert patient
$conn->query("INSERT INTO patients(name, age) VALUES('$name', $age)");
$patient_id = $conn->insert_id;

// Insert symptoms
$conn->query("INSERT INTO symptoms(patient_id, description) VALUES($patient_id, '$symptoms')");

// Diagnosis
$diagnosis = "General Condition";
$advice = "Rest and monitor your symptoms.";

// Convert to lowercase for better matching
$symptoms = strtolower($symptoms);

// RULE SET
$conditions = [

    // HEART
    ["keyword" => "chest pain",
     "diagnosis" => "Possible Heart Issue",
     "advice" => "Sit down, stay calm, avoid movement, and call emergency services immediately."],

    // FEVER
    ["keyword" => "fever",
     "diagnosis" => "Fever / Infection",
     "advice" => "Drink fluids, rest, and take paracetamol if needed."],

    // DEHYDRATION
    ["keyword" => "dizzy",
     "diagnosis" => "Possible Dehydration",
     "advice" => "Drink ORS (1L water + 6 tsp sugar + 1/2 tsp salt), rest in a cool place."],

    ["keyword" => "weak",
     "diagnosis" => "Possible Dehydration",
     "advice" => "Drink ORS and avoid heat exposure."],

    // COUGH / COLD
    ["keyword" => "cough",
     "diagnosis" => "Cold or Respiratory Issue",
     "advice" => "Drink warm fluids, rest, avoid cold drinks."],

    ["keyword" => "sore throat",
     "diagnosis" => "Throat Infection",
     "advice" => "Gargle warm salt water and stay hydrated."],

    // HEADACHE
    ["keyword" => "headache",
     "diagnosis" => "Headache / Migraine",
     "advice" => "Rest in a quiet place and stay hydrated."],

    // STOMACH ISSUES
    ["keyword" => "stomach pain",
     "diagnosis" => "Gastric Issue",
     "advice" => "Avoid spicy food and drink warm water."],

    ["keyword" => "diarrhea",
     "diagnosis" => "Possible Food Infection",
     "advice" => "Drink ORS frequently and avoid solid food temporarily."],

    ["keyword" => "vomiting",
     "diagnosis" => "Food Poisoning / Infection",
     "advice" => "Drink small amounts of water and rest."],

    // BREATHING
    ["keyword" => "shortness of breath",
     "diagnosis" => "Breathing Difficulty",
     "advice" => "Sit upright, stay calm, and seek immediate medical help."],

    // INJURY
    ["keyword" => "bleeding",
     "diagnosis" => "Injury",
     "advice" => "Apply pressure to stop bleeding and seek help."],

    // HEAT
    ["keyword" => "heat",
     "diagnosis" => "Heat Exhaustion",
     "advice" => "Move to a cool place and drink fluids immediately."]
];

// LOOP THROUGH RULES
foreach ($conditions as $condition) {
    if (strpos($symptoms, $condition["keyword"]) !== false) {
        $diagnosis = $condition["diagnosis"];
        $advice = $condition["advice"];
        break;
    }
}

// Save diagnosis
$conn->query("INSERT INTO diagnostics(patient_id, diagnosis) VALUES($patient_id, '$diagnosis')");

echo "<h2>Diagnosis: $diagnosis</h2>";
echo "<h3>💡 Advice:</h3>";
echo "<p>$advice</p>";
echo "<p style='color:red;'><b>⚠️ Not a medical diagnosis. Consult a doctor.</b></p>";
?>