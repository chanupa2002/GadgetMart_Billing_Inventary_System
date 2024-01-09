<?php
session_start();
require_once('connection.php');

if (isset($_GET['user_id'])) {
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

    // Perform the deletion query
    $query = "DELETE FROM products WHERE id = $user_id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Redirect back to the manage bookings page after deletion
        header("Location: edit.php");
        exit();
    } else {
        // Handle deletion failure
        echo "Error deleting booking: " . mysqli_error($connection);
    }
} else {
    // Handle missing user_id parameter
    echo "Invalid request. User ID not provided.";
}
?>
