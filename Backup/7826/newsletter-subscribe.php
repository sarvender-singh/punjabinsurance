<?php
// newsletter-subscribe.php
// Called via AJAX POST from footer newsletter form on all pages

include 'includes/emailconfig.php';

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$email = htmlspecialchars(strip_tags(trim($_POST['email'] ?? '')), ENT_QUOTES, 'UTF-8');

// Validate
if ($email === '') {
    echo json_encode(['success' => false, 'message' => 'Email address is required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

// Send email
$subject = 'New Newsletter Subscription';

$message = '<p>Hi Admin,</p>
<table>
<tr><td><strong>New Newsletter Subscriber : </strong></td><td>' . $email . '</td></tr>
</table>';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'Bcc: ' . $bcc . "\r\n";
$headers .= 'From: ' . $from_name . ' <' . $noreplyemail . '>' . "\r\nReply-to: " . $email;

if (mail($to_email, $subject, $message, $headers, '-f ' . $noreplyemail)) {
    echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again.']);
}
exit;

?>