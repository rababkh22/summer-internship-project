<!DOCTYPE html>
<html lang="en">
<?php
include("connexion.php");

if (isset($_POST['save'])) {
    $image_name = $_POST['imagename'];
    $num=$_POST['num_indiv'];
    $filename = $_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];
    $selectedFolder = $_POST['selected_folder'];

    if (empty($filename) || $_FILES["img"]["size"] === 0) {
        echo ' <script>alert("Empty input! Try to upload an image!");</script>';
    } 
    elseif (empty($image_name)) {
      echo '<script>alert("Please enter an image name.");</script>';
     }
    else {
        if ($selectedFolder === "Combinedimages") {
            $folder = "./images_adm/" . $image_name .'.png';
            $query = "INSERT INTO combination_images (combination_name,num_individual_images) VALUES (?,?)";

            if (move_uploaded_file($tempname, $folder)) {
                $stmt = $mysqli->prepare($query);
                // Bind the parameters to the statement
                $stmt->bind_param("ss", $image_name,$num);
                $stmt->execute();
                echo ' <script>alert("Image uploaded successfully!");</script>';
            } else {
                echo '<script>alert("Error occurred while uploading the image. Please try again.");</script>';
            }
        } else {
            $query = "INSERT INTO individual_images (category, image_name) VALUES (?, ?)";
            $stmt = $mysqli->prepare($query);
            // Bind the parameters to the statement
            $stmt->bind_param("ss", $selectedFolder, $image_name);
            $folder = "./images_usr/" . $selectedFolder . "/" . $image_name .'.png';

            if (move_uploaded_file($tempname, $folder)) {
                $stmt->execute();
                echo ' <script>alert("Image uploaded successfully!");</script>';
            } else {
                echo '<script>alert("Error occurred while uploading the image. Please try again.");</script>';
            }
        }
    }
}
if (isset($_POST['save_categ'])) {
  $image_name = $_POST['imagename'];
  $category = $_POST['image_category'];
  $filename = $_FILES["img"]["name"];
  $tempname = $_FILES["img"]["tmp_name"];
  $selectedFolder = $_POST['imagecategory'];

  if (empty($filename) || $_FILES["img"]["size"] === 0) {
      echo ' <script>alert("Empty input! Try to upload an image!");</script>';
  } 
  elseif (empty($image_name)) {
    echo '<script>alert("Please enter an image name.");</script>';
   }
  else {
      if ($selectedFolder === "Combined Images") {
          $folder = "./images_adm/" . $image_name .'.png';
          $query = "INSERT INTO combination_images (combination_name) VALUES (?)";

          if (move_uploaded_file($tempname, $folder)) {
              $stmt = $mysqli->prepare($query);
              // Bind the parameters to the statement
              $stmt->bind_param("s", $image_name);
              $stmt->execute();
              echo ' <script>alert("Image uploaded successfully!");</script>';
          } else {
              echo '<script>alert("Error occurred while uploading the image. Please try again.");</script>';
          }
      } else {
          $query = "INSERT INTO individual_images (category, image_name) VALUES (?, ?)";
          $stmt = $mysqli->prepare($query);
          // Bind the parameters to the statement
          $stmt->bind_param("ss", $category, $image_name);
          $folder = "./images_usr/" . $category . "/" . $image_name .'.png';

          if (move_uploaded_file($tempname, $folder)) {
              $stmt->execute();
              echo ' <script>alert("Image uploaded successfully!");</script>';
          } else {
              echo '<script>alert("Error occurred while uploading the image. Please try again.");</script>';
          }
      }
  }
}
?>
<?php

//   if(isset($_POST['submit'])){
//     $nb_images=$_POST["nb"];
//     for($i=1;$i<=$nb;$i++){
//       echo'<form method="POST" action="" enctype="multipart/form-data">
//       <div class="input-group mb-3" id="upload">
//         <input type="file"  name="img" class="form-control" id="inputGroupFile02" value=""/>
//         <button class="input-group-text" type="submit" name="save">Upload</button>
//       </div>
//     </form>';
//     }

//   }
// 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="style_adm.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
   
  <title>Stockage des images</title>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
    
        <div class="container-fluid">
          <a class="navbar-brand" href="#" id="clr">ADD NEW IMAGES</a>
          <a class="navbar-brand" href="#" id="combine">COMBINE IMAGES</a>
          <!-- <a class="navbar-brand" href="#" id="delete">DELETE IMAGES</a> -->
                <!-- <label for="colorDropdown" id="clr">CATEGORY</label>
                <select id="colorDropdown">
                  <option value="Instruments1">Instruments1</option>
                  <option value="Instruments2">Instruments2</option>
                  <option value="Instruments3">Instruments3</option>
                  <option value="Instruments3">Instruments4</option>
                  <option value="Instruments4">Instruments5</option>
                </select> -->
          <!-- <form class="d-flex" role="search">
            <label >Number of images</label>
            <input class="form-control me-2" type="number" placeholder="Number of images"  name="nb" min="1" value="1" aria-label="Number of images">
            <button class="btn btn-outline-success" type="submit" id="clr" name="submit">submit</button>
          </form>    -->
             
        </div>
      </nav>
      <form method="POST" action="" enctype="multipart/form-data" id="form">
      
        <div class="input-group mb-3" id="upload">
          <div class="form-group">
            <!-- <label for="imagename">Image Name</label> -->
            <div class="form-group">
              <input type="file"  name="img" class="form-control" id="inputGroupFile02" value=""/>
            </div>
            <div class="form-group">
              <input type="text"  name="imagename" class="form-control" placeholder="Image Name" value=""/>
            </div>
            <div class="form-group">
              <input type="number"  name="num_indiv" class="form-control" placeholder="num of individual images to combine" min="2" value=""/>
            </div>
            <div class="form-group">
              <button class="input-group-text" type="submit" name="save" style="background-color:#428bf1;">Upload</button>
            </div>
            
          </div>  
          <input type="hidden" name="selected_folder" id="selectedFolder" value=""/>
          <img id="image" src="<?php "' . $folder . '" ?>"  style="display: none;">
          
        </div>
      </form>
      
      <form method="POST" action="" enctype="multipart/form-data" id="form_category">
      
        <div class="input-group mb-3" id="upload">
          <div class="form-group">
            <!-- <label for="imagename">Image Name</label> -->
            <div class="form-group">
              <input type="file"  name="img" class="form-control" id="inputGroup0" value=""/>
            </div>
            <div class="form-group">
              <input type="text"  name="imagename" class="form-control" placeholder="Image Name" id="inputGroup" value=""/>
            </div>
            <div class="form-group">
              <select  name="imagecategory" class="form-control" placeholder="category" id="select_categ" style="position:center;" >
                <option value="Individual Images">Individual Images</option>
                <option value="Combined Images">Combined Images</option>
              </select>  
            </div>
            
            <div class="form-group">
              <select  name="image_category" class="form-control" placeholder="category" id="inputcateg" style="position:center;" >
                
                <option value="Instruments1">Instruments1</option>
                <option value="Instruments2">Instruments2</option>
                <option value="Instruments3">Instruments3</option>
                <option value="Instruments4">Instruments4</option>
                <option value="Instruments5">Instruments5</option>
              </select> 
            <!-- <input type="text"  name="imagcategory" class="form-control" placeholder="Category" id="inputcateg" value=""/> -->
            </div>
            <div class="form-group">
              <button class="input-group-text" type="submit" name="save_categ" style="background-color:#428bf1;" id="save_categ">Upload</button>
            </div>
            
          </div>  
          <!-- <input type="hidden" name="selected_folder" id="selectedFolder" value=""/>
          <img id="image" src="<?php "' . $folder . '" ?>"  style="display: none;"> -->
          
        </div>
      </form>
 
      <div class="menu" id="menu">
      <ul id="imageList">
        <?php
        include("connexion.php");
     
        
        // Fetch categories from the database
        $query = "SELECT DISTINCT category FROM individual_images";
        $result = $mysqli->query($query);
        echo '<li class="dropdown" data-folder="Individualimages" >';
        echo '<a  id="nocategory" style="color:white;font-weight:bold;">Individual images</a>';
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = $row['category'];
                
                echo '<li class="dropdown" data-folder="'.$category.'">';
                echo '<a href="#" id="category">' . $category . '</a>';
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
            $query = "SELECT * FROM combination_images";
            $result = $mysqli->query($query);
            
            
            echo '<li class="dropdown" data-folder="Combinedimages" >';
            echo '<a href="#" id="cmb_category" style="font-weight:bold;">Combined images</a>';
            echo '<ul class="dropdown-content">';
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            
                 $image_path='images_adm/'.$row['combination_name'].'.png';
                    echo '<li><img src="' . $image_path . '"  class="draggable" id="' . $row['combination_id'] . '"></li>';
                }
            }
            
            echo '</ul>';
            echo '</li>';
         }
         else {
          echo'</li>';
          echo '<a  id="no_categ" style="color:white;text-decoration:none;">No categories found in the database click here to add categories</a>';
            

        }
        
      
          
      ?>
    
      </ul>  
    </div> 
    <form method="POST" action="save_combination.php">
    <div class="form-group" id="choose_img">
     <p id="cmb">Choose Combined Image:</p>
      <?php
      $query = "SELECT * FROM combination_images";
      $result = $mysqli->query($query);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      
           $image_path='images_adm/'.$row['combination_name'].'.png';
           echo '<div id="check-container">
           <div  id="check">
           
           <img src="' . $image_path . '"  id="disp-images"alt="' . $row['combination_name'] . '">
           <p>' .$row['combination_name'] .'</p>
           <input type="radio" name="combinedImage" value="' . $row['combination_id'] . '">
           

           </div>
           </div>';
              // echo '<li><img src="' . $image_path . '"  class="draggable" id="' . $row['combination_id'] . '"></li>';
          }
      }
    
     else {
      echo "No categories found in the database.";
  }
    
    
      ?>

</div>
<div class="form-group" id="indiv_img">
     <p id="cmb">Choose Images:</p>
      <?php
          $query = "SELECT DISTINCT category FROM individual_images";
          $result = $mysqli->query($query);
          
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $category = $row['category'];
                  echo '<div class="category-container">';
                  echo '<li id="category">' . $category . '</li>';
                  
                  
                  // Fetch images for the current category
                  $imageQuery = "SELECT * FROM individual_images WHERE category = '$category'";
                  $imageResult = $mysqli->query($imageQuery);
                  
                  if ($imageResult && $imageResult->num_rows > 0) {
                      while ($imageRow = $imageResult->fetch_assoc()) {
                        $image_path='images_usr/'. $imageRow['category']. '/' .$imageRow['image_name'].'.png';
                        echo '<div id="check-container">
                        <div  id="check">
                        <img src="' . $image_path . '"  id="disp-images"alt="' . $imageRow['image_name'] . '">
                        <p>' .$imageRow['image_name'] .'</p>
                        <input type="checkbox" name="individualImages[]" value="' . $imageRow['image_id'] . '">
                        </div>
                        </div>';
                          
                          
                      }
                  }
                 echo'</div>';  
               
                }
              }
          
              // echo '<li><img src="' . $image_path . '"  class="draggable" id="' . $row['combination_id'] . '"></li>';
       
    
     else {
      echo "No categories found in the database.";
  }
    
    
      ?>
   <button  class="btn btn info" type="button" id="submitImages" style="display: none;background-color:grey;">Submit</button>       

</div>

</form>


  
    

   
    <!-- <img src="" class="combined-image"> -->
    <script src="file_adm1.js"></script>
    
</body>
</html>


 
    
     