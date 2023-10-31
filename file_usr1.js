$(document).ready(function() {
  // $("#menu_usr").hide();
    var totalDroppedImages = 0;
    var expectedDroppedImages = 2;
     // Change this value to the number of images you expect to be dropped
    
  
    $("img").on("click", function() {
      $(this).animate({right: '25px',width:'190px',height:'190px'}, "slow");
    });
  
    $("img").on("dblclick", function() {
      $(this).animate({width:'50px',height:'50px',position:'relative',left:'1px'});
      $(this).stop();
    });
  
    $(".dropdown").on("mouseenter", function() {
      $(this).children(".dropdown-content").slideDown();
      $(".dropdown-content:not($(this).children('.dropdown-content'))").slideUp();
    });
    $("li a").on("click", function() {
        $(".dropdown").children(".dropdown-content").slideUp();
        
      });
       // Toggle the visibility of the menu when clicking on the link
       $("#clr").click(function() {
        $("#historique").hide();
        $("#menu_usr").toggle();
        
      });
      $("#combine").click(function() {
        $("#menu_usr").hide();
        $("#imageContainer").hide();
        $(".combined-image").hide();
        // $("#historique").show();
        displayHistoriqueOfCombinations()
      });
        
      

    var droppedImageIds = []; // Array to store IDs of dropped images
    var generatedCombinedImages = [];
  
    // $(".draggable").draggable();
    $(".draggable").draggable({
        revert: "invalid",
        cursor: "grabbing",
        helper: "clone"
      });
    
  
    $("#imageContainer").droppable({
      drop: function (event, ui) {
        $("#imageContainer").empty();
        var droppedImage = ui.draggable.clone();
        droppedImage.appendTo(this);
  
        // Style the dropped image
        droppedImage.css({
        position: "absolute",
        top: ui.position.top,
        left: ui.position.left,
        cursor: "grab"
        });
        
    
          droppedImage.animate({
            top: "50%",
            left: "50%",
            width: "300px",
            height: "200px",
            // width: "200px",
            // height: "200px",
            marginLeft: "-150px",
            marginTop: "-100px"
          }, "slow");
         
        // Store the ID of the dropped image in the array
        droppedImageIds.push(droppedImage.attr("id"));
        
        totalDroppedImages++; // Increment the count of dropped images
       
          //AJAX POST REQUEST
          $.post("combination.php", { imageIds: droppedImageIds }, function(data) {
            var result = JSON.parse(data);
            if (result.combinationPath) {
              // Display the combined image
              $("#imageContainer").empty();
              var pic=$(".combined-image").attr("src", result.combinationPath);
              var num_individual_images = result.num_individual_images;
              generatedCombinedImages.push(result.combinationPath);
              pic.css({
                position: "absolute",
                top: "50%",
                left: "50%",
                transform: "translate(-50%, -50%)",
                width: "300px",
                height: "200px"
            }).fadeIn("slow");
              
              expectedDroppedImages = num_individual_images;
            }
            // } else {
            //   alert(result.error);
            // }
          });
          alert(result.error);
         // totalDroppedImages = 0; // Reset the counter after displaying the combined image
        
      }
  
 // }
});

// function displayHistoriqueOfCombinations() {
//   var historiqueContainer = $("#historique");
//   historiqueContainer.empty();

//   for (var i = 0; i < generatedCombinedImages.length; i++) {
//     var combinedImage = generatedCombinedImages[i];
//     var imgElement = '<img src="' + combinedImage + '" alt="Historique Combination ' + (i + 1) + '" style="position:absolute;top:50%;left:50%;width:300px;height:200px;">';
//     historiqueContainer.append(imgElement);
//   }

//   historiqueContainer.show();

//   // Sauvegarder l'historique dans le stockage local
//   localStorage.setItem('generatedCombinedImages', JSON.stringify(generatedCombinedImages));
// }


  
 
});
 

 
