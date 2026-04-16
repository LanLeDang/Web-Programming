// ── Read existing cookies from the browser ──────────────
$lasttime   = isset($_COOKIE['LAST_VISIT'])   ? $_COOKIE['LAST_VISIT']        : '';
$visitcount = isset($_COOKIE['VISIT_NUMBER']) ? (int)$_COOKIE['VISIT_NUMBER']  : 0;
$firstvisit = isset($_COOKIE['FIRST_VISIT'])  ? $_COOKIE['FIRST_VISIT']       : '';

// ── Build new timestamp ─────────────────────────────────
$LAST_VISIT = date('l, F j, Y') . ' at ' . date('g:i A');

// ── Write updated cookies (MUST be before DOCTYPE) ──────
setcookie('LAST_VISIT',   $LAST_VISIT,           time() + 3600 * 24 * 14);
setcookie('VISIT_NUMBER', $visitcount + 1,         time() + 3600 * 24 * 14);

// ── Step 8: Record the very FIRST visit date ─────────────
if ($firstvisit === '') {                              // Only write once
    setcookie('FIRST_VISIT', $LAST_VISIT, time() + 3600 * 24 * 365); // 1 year
} else {
    setcookie('FIRST_VISIT', $firstvisit, time() + 3600 * 24 * 365); // Refresh
}



// SESSION-COOKIES-2.PHP



session_start();  // Resume or create server-side session
$processingOK = 'not yet';
$firstLogin   = 'no';

if (isset($_SESSION['authorized'])) {
    // Path A: Session already existed → user logged in a moment ago
    $processingOK = $_SESSION['authorized'];

} else {
    // Path B: New session → check submitted password
    $password = trim($_POST['password'] ?? '');
    if ($password === 'Test') {
        $processingOK             = 'ok';
        $_SESSION['authorized']   = 'ok';  // ← Written to the SERVER
        $firstLogin               = 'yes';
    }
    // Wrong password: $processingOK stays 'not yet'
}



// SESSION-COOKIES-3.PHP



session_start();            // Loads the session by PHPSESSID cookie
$processingOK = 'not yet';  // Default: assume not authorized

if (isset($_SESSION['authorized'])) {
    $processingOK = $_SESSION['authorized'];
    // ✅ Found 'ok' — written by Lab 2 when you logged in
}

if ($processingOK !== 'ok') {
    // Show failure message and stop
    exit();
}
// ✅ If we reach here, user is authorized — show protected content

