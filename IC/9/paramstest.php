<?php
function safe($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<h1>No form data received.</h1>";
    exit;
}

$name      = safe($_POST["name"] ?? "");
$email     = safe($_POST["email"] ?? "");
$address   = safe($_POST["address"] ?? "");
$ccard     = safe($_POST["ccard"] ?? "");
$dob       = safe($_POST["dob"] ?? "");
$gender    = safe($_POST["gender"] ?? "");
$phone     = safe($_POST["phone"] ?? "");
$track     = safe($_POST["track"] ?? "");
$statement = safe($_POST["statement"] ?? "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Results</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      background: linear-gradient(135deg, #e0f2fe, #eef2ff);
      color: #0f172a;
      padding: 30px;
    }
    .container {
      max-width: 950px;
      margin: auto;
      background: #ffffff;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 18px 35px rgba(0,0,0,0.12);
    }
    pre {
      background: #0f172a;
      color: #e2e8f0;
      padding: 18px;
      border-radius: 14px;
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 12px;
      margin-bottom: 24px;
    }
    th, td {
      border: 1px solid #cbd5e1;
      padding: 12px;
      text-align: left;
    }
    th {
      background: #dbeafe;
      width: 220px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Processed Form Submission</h1>

    <h2>Raw Form Data</h2>
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

    <h2>All Form Data</h2>
    <ul>
      <?php
      foreach ($_POST as $key => $value) {
          if (is_array($value)) {
              $value = implode(", ", $value);
          }
          echo "<li><strong>" . safe($key) . ":</strong> " . safe($value) . "</li>";
      }
      ?>
    </ul>
  </div>
</body>
</html>