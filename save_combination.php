<?php

include("connexion.php");

// Check if the request is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the combined image ID and individual image IDs from the AJAX request
    $combinedImageId = $_POST['combinedImageId'];
    $individualImageIds = $_POST['individualImageIds'];

    // Perform any necessary data validation here

    // Insert the combination into the image_combinations table
    $insertQuery = "INSERT INTO image_combinations (combination_id, image_id) VALUES (?, ?)";
    $insertStmt = $mysqli->prepare($insertQuery);

    // Bind the combined image ID and individual image IDs to the statement
    $insertStmt->bind_param("ii", $combinedImageId, $individualImageId);

    // Execute the statement for each individual image ID
    foreach ($individualImageIds as $individualImageId) {
        if (!$insertStmt->execute()) {
        // Handle the error if the insertion fails
            echo "Error occurred while saving the combination.";
            exit();
        }
    }

   
    $insertStmt->close();


    echo "Combination saved successfully!";
} else {
   
    echo "Invalid request method.";
}
?>
