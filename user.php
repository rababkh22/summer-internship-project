<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="style_usr.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
    
     <!-- <script src="addimages.js"></script>  -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
     <title>Document</title>

  </head>

  <body>
  <nav class="navbar navbar-expand-lg" style="background-color:#28a745;">
    
    <div class="container-fluid">
      <a class="navbar-brand" href="#" id="clr">MENU</a>
      <!-- <a class="navbar-brand" href="#" id="combine">HISTORIQUE OF COMBINATIONS</a> -->
    </div> 
  </nav>  
    <div class="menu"  id="menu_usr">
      <ul id="imageList">
        <?php
        include("connexion.php");
     
        
        // Fetch categories from the database
        $query = "SELECT DISTINCT category FROM individual_images";
        $result = $mysqli->query($query);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = $row['category'];
                echo '<li class="dropdown">';
                echo '<a href="#">' . $category . '</a>';
                echo '<ul class="dropdown-content">';
                
                // Fetch images for the current category
                $imageQuery = "SELECT * FROM individual_images WHERE category = '$category'";
                $imageResult = $mysqli->query($imageQuery);
                if ($imageResult && $imageResult->num_rows > 0) {
                    while ($imageRow = $imageResult->fetch_assoc()) {
                        $image_path='images_usr/'. $imageRow['category']. '/' .$imageRow['image_name'].'.png';
                        echo '<li><img src="' . $image_path . '"  class="draggable" id="' . $imageRow['image_id'] . '"></li>';
                    }
                }
                
                echo '</ul>';
                echo '</li>';
            }
        } else {
            echo "No categories found in the database.";
        }
        
        // Close the database connection
        $mysqli->close();
        
        
        ?>
          </ul>  
    </div> 
    
    
    
    <script src="file_usr1.js"></script>

<div class="image-container" id="imageContainer">
  <p class="image-title">Drop images here</p>
  <p class="add">+</p>
 
</div>
<!-- <div class="form-group">
<button type="submit" class="btn btn info" id="sub">SUBMIT</button> 
</div> -->
<img src="" class="combined-image">


<div id="historique"></div>



<!-- <div  class="menu" id="historique">
  <li class="dropdown">';
    <ul class="dropdown-content">';
      <li><img src=""  id="hist" style="display:none;"></li>
    </ul>
  </li>  

</div> -->
 
</body>
</html>
