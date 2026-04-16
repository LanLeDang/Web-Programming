<?php
function safe($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<h1>No form data received. Please submit the form first.</h1>";
    exit;
}

// Capture and sanitize data
$name      = safe($_POST["name"] ?? "Not provided");
$email     = safe($_POST["email"] ?? "Not provided");
$address   = safe($_POST["address"] ?? "Not provided");
$ccard     = safe($_POST["ccard"] ?? "Not provided");
$dob       = safe($_POST["dob"] ?? "Not provided");
$gender    = safe($_POST["gender"] ?? "Not provided");
$phone     = safe($_POST["phone"] ?? "Not provided");
$track     = safe($_POST["track"] ?? "Not provided");
$statement = safe($_POST["statement"] ?? "Not provided");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Results</title>
    <style>
        body { font-family: sans-serif; background: #eef2ff; padding: 30px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #cbd5e1; padding: 12px; text-align: left; }
        th { background: #dbeafe; width: 30%; }
        pre { background: #0f172a; color: #e2e8f0; padding: 15px; border-radius: 8px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Processed Form Submission</h1>

        <h2>Raw Form Data (For Debugging)</h2>
        <pre><?php print_r($_POST); ?></pre>

        <h2>User Signup Details</h2>
        <table>
            <tr><th>Name</th><td><?php echo $name; ?></td></tr>
            <tr><th>Email</th><td><?php echo $email; ?></td></tr>
            <tr><th>Address</th><td><?php echo $address; ?></td></tr>
            <tr><th>Credit Card</th><td><?php echo $ccard; ?></td></tr>
            <tr><th>Date of Birth</th><td><?php echo $dob; ?></td></tr>
            <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
            <tr><th>Phone</th><td><?php echo $phone; ?></td></tr>
            <tr><th>Track</th><td><?php echo $track; ?></td></tr>
            <tr><th>Statement</th><td><?php echo $statement; ?></td></tr>
        </table>

        <h2>Dynamic Loop</h2>
        <ul>
            <?php
            foreach ($_POST as $key => $value) {
                echo "<li><strong>" . safe($key) . ":</strong> " . safe($value) . "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>