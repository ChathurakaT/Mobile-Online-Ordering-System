<?php
include("connection/connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if user is logged in
    if (isset($_SESSION['user_id']) && !empty($_POST['review']) && isset($_POST['rating'])) {
        $user_id = $_SESSION['user_id'];
        $product_title = $_POST['name'];
        $review = $_POST['review'];
        $rating = (int)$_POST['rating'];

        // Prepare SQL statement
        $stmt = $db->prepare("INSERT INTO product_reviews (user_id, product_title, review, rating) VALUES (?, ?, ?, ?)");
        
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("issi", $user_id, $product_title, $review, $rating);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<p style='text-align: center; color: green; font-size: 50px; padding-top:100px;'>Review added successfully!<br/>Thank You 😊🎉</p>";
                // Display Home button
                echo "<p style='text-align: center;'><a href='index.php' style='display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border-radius: 5px;'>Go to Home</a></p>";
            } else {
                echo "<p style='text-align: center; color: red;'>Error: Could not save your review. Details: " . $stmt->error . "</p>";
            }
            

            $stmt->close();
        } else {
            // Output SQL error for debugging
            echo "<p style='text-align: center; color: red;'>SQL Error: " . $db->error . "</p>";
        }
    } 
    
}

$db->close();

?>
