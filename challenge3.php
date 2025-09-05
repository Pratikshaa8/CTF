<?php
// Challenge: Shadowed Gateway 
$users = [
    1 => "admin",
    7 => "player"
];


$user_id = $_GET['user'] ?? 7;
$token   = $_GET['token'] ?? "abc123";

if (($user_id == 1 && $token == "admin_access") || ($user_id != 1 && $token == "abc123")) {
    echo "<h2>Welcome, " . $users[$user_id] . "</h2>";

        if ($user_id == 1 && $token == "admin_access") {
        echo "<p>🎉 Here is your hidden flag:</p>";
        echo "<b>H4CK3RF0RGE{shadowed_admin_key}</b>";
    }
} else {
    echo "<p>❌ Access denied. The shadows are watching.</p>";
}
?>
