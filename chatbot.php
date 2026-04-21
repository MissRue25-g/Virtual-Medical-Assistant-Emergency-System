<?php
$message = strtolower($_POST['message']);

if (strpos($message, "chest pain") !== false) {
    echo "⚠️ Possible heart issue. Press emergency button immediately.";
}
elseif (strpos($message, "fever") !== false) {
    echo "🤒 You may have an infection. Stay hydrated and monitor temperature.";
}
elseif (strpos($message, "headache") !== false) {
    echo "💡 Could be stress or dehydration. Drink water and rest.";
}
else {
    echo "❓ Please provide more symptoms.";
}
?>