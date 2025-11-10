<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form values
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name  = htmlspecialchars($_POST['last_name']);
    $email      = htmlspecialchars($_POST['email']);
    $password   = htmlspecialchars($_POST['password']); // You can hash this if needed
    $gender     = htmlspecialchars($_POST['gender']);
    $interests  = htmlspecialchars($_POST['interests']);

    // CSV file path
    $file = 'signups.csv';

    // Check if file exists to add header
    if (!file_exists($file)) {
        $header = ['First Name', 'Last Name', 'Email', 'Password', 'Gender', 'Interests'];
        $fp = fopen($file, 'w');
        fputcsv($fp, $header);
    } else {
        $fp = fopen($file, 'a');
    }

    // Save form data as a new row
    $data = [$first_name, $last_name, $email, $password, $gender, $interests];
    if (fputcsv($fp, $data)) {
        fclose($fp);
        echo "Thank you! Your sign-up has been saved.";
    } else {
        fclose($fp);
        echo "Sorry, there was an error saving your sign-up.";
    }
} else {
    echo "Invalid request.";
}
?>
