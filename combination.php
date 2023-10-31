<?php 

// include("connexion.php");

// if (isset($_POST['imageIds'])) {
//   $imageIds = $_POST['imageIds'];
//   if (is_array($imageIds)) {
//     $imageIds = implode(",", $imageIds);
// }

// $imageIdsArray = explode(",", $imageIds);
// $conditionString = implode(",", array_map('intval', $imageIdsArray));


//   // Query to fetch the combined image path based on the conditionString

// $query = "SELECT  combination_name FROM combination_images WHERE combination_id IN (SELECT combination_id FROM image_combinations WHERE image_id IN ($conditionString) GROUP BY combination_id HAVING COUNT(DISTINCT image_id) = " . count($imageIdsArray) . ")";  

// $result = $mysqli->query($query);

//   if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $combinationName = $row['combination_name'];
//      // Create the correct image path with forward slashes
//     // $combinationPath = 'images_adm/' . str_replace('\/', '/', $combinationName) . '.png';
//     $combinationPath='images_adm/' .$combinationName.'.png';
    
    
//     echo json_encode(array('combinationPath' => $combinationPath));
//   } else {
//     echo json_encode(array('error' => 'No matching combination found.'));
//   }
// } else {
//   echo json_encode(array('error' => 'Invalid request.'));
// }
include("connexion.php");

if (isset($_POST['imageIds'])) {
    $imageIds = $_POST['imageIds'];
    
    // Convert the image IDs to an array of integers
    $imageIdsArray = array_map('intval', $imageIds);
    
    // Build a comma-separated string of image IDs by concatenation
    $conditionString = implode(",", $imageIdsArray);
    
    // Query to find a matching combination based on the dropped images
    $query = "SELECT c.combination_name, c.num_individual_images
FROM combination_images c
WHERE c.combination_id IN (
  SELECT ic.combination_id
  FROM image_combinations ic
  WHERE ic.image_id IN ($conditionString)
  GROUP BY ic.combination_id
  HAVING COUNT(DISTINCT ic.image_id) = c.num_individual_images
)";
    
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $combinationName = $row['combination_name'];
        $num_individual_images = $row['num_individual_images'];
        $combinationPath = 'images_adm/' . $combinationName . '.png';
        
        // Return the path of the matching combined image
        echo json_encode(array('combinationPath' => $combinationPath, 'num_individual_images' => $num_individual_images));
    } else {
        echo json_encode(array('error' => 'No matching combination found.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request.'));
}





?>

  
  
  