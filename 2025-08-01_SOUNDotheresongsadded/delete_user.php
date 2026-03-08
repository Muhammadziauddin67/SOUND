<?php
include ('dbconnection.php');


// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    // Get the user_id from the URL
    $user_id = $_GET['id'];

    // SQL query to delete the user from the database
    $sql = "DELETE FROM users WHERE user_id = ?";
    
    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        // Bind the user_id to the prepared statement
        $stmt->bind_param("i", $user_id);
        
        // Execute the deletion
        if ($stmt->execute()) {
            // Redirect to the index page after successful deletion
            echo "<script>alert('deleted successfully')</script>";
            header("Location: admin_panel.php?message=User+deleted+successfully");
        } else {
            // Handle the error if deletion fails
            echo "Error: " . $stmt->error;
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>







