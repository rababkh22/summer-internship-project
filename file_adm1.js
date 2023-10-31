
  $(document).ready(function() {
  var individualImageIds = [];
  
    $("#menu").hide();
    $("#clr").click(function() {
      $("#choose_img").hide();
      $("#indiv_img").hide();
      $("#menu").toggle();
      
    });
    $("li img").on("click", function() {
      $(this).animate({right: '25px',width:'190px',height:'190px'}, "slow");
    });
  
    $("li img").on("dblclick", function() {
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
  $("li").click(function() {
    $("#choose_img").hide();
    $("#menu").hide();
    $("#indiv_img").hide();
    var folderName = $(this).data("folder");
    
    // Set the value of the hidden input field to the selected folder
    $("#selectedFolder").val(folderName);
    // $(this).show();
    
    // $("#form").toggle();
    
    
    
   
  });
  $("#cmb_category").click(function() {
    $("#form").hide();
    $("#indiv_img").hide();
    $("#choose_img").hide();
    $("#form_category").hide();
    $("#form").toggle();


    // $("#choose_img").css({display:"flex"});
 
   
  });
  $("#no_categ").click(function() {
    $("#form").hide();
    $("#indiv_img").hide();
    $("#choose_img").hide();
    // $("#form_category").toggle();
    // $("#inputGroup").hide(); 
    // $("#save_categ").hide();
    $("#form_category").toggle();


    // $("#choose_img").css({display:"flex"});
 
   
  });
  $("#nocategory").click(function() {
    $("#form").hide();
    $("#indiv_img").hide();
    $("#choose_img").hide();
    $("#form_category").toggle();
    // $("#inputcateg").css({display:'none'});
   


    // $("#choose_img").css({display:"flex"});
 
   
  });
  $("#combine").click(function() {
    $("#menu").hide();
    $("#form").hide();
    $("#indiv_img").hide();
    $("#form_category").hide();
    $("#choose_img").toggle();
    
    // $("#choose_img").css({display:"flex"});
 
   
  });
  
  $("#select_categ").change(function() {
    var selectedCategory = $(this).val(); 
    if(selectedCategory=="Individual Images"){
     $("#form_category").toggle();
    }else{
      $("#inputcateg").hide();
    }


  });
  // $("#delete").click(function() {
  //   $("#menu").hide();
  //   $("#choose_img").toggle();
  //   $("#indiv_img").toggle();
  //   $("input[type='radio']").hide();
  //   $("input[type='checkbox']").show();
    
    
  // });
 
  // $("#inputGroup1").hide();
  


  // Écouter l'événement de changement sur l'élément select
// $("#select_categ").change(function() {
//   // Récupérer la valeur sélectionnée
//   var selectedCategory = $(this).val();
 
  
//     $("#inputGroup").toggle(); 
//     $("#save_categ").toggle(); 
    

//   // Faire quelque chose avec la valeur sélectionnée
//   console.log("Catégorie sélectionnée : " + selectedCategory);
   
// });

 
var combinedImageId = 0;
var individualImageIds = [];

$("input[name='combinedImage']").change(function() {
  combinedImageId = $(this).val();
  $("#choose_img").hide();
  $("#indiv_img").toggle();
  $("#submitImages").hide(); // Hide the "Submit" button when switching back to combined image selection
  });


// When the user selects individual images
$('input[name="individualImages[]"]').on('change', function() {
  var individualImageId = $(this).val();

  if ($(this).is(':checked')) {
    individualImageIds.push(individualImageId);
  } else {
    var index = individualImageIds.indexOf(individualImageId);
    if (index !== -1) {
      individualImageIds.splice(index, 1);
    }
  }

  // Show the "Submit" button when at least one individual image is selected
  if (individualImageIds.length > 1) {
    $("#submitImages").show();
  } else {
    $("#submitImages").hide();
  }
});

// When the user clicks on "Submit" button
$("#submitImages").on('click', function() {
  // Perform an AJAX request to save the combination
  $.ajax({
    url: 'save_combination.php', // Replace with the PHP script to save the combination
    type: 'POST',
    data: {
      combinedImageId: combinedImageId,
      individualImageIds: individualImageIds
    },
    success: function(response) {
      // Handle the success response
      alert("Combination saved successfully!");
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.log(error);
      alert("Error occurred while saving the combination. Please try again later.");
    }

  });
  $("#indiv_img").hide();
  $("#choose_img").hide(); 
  
});


  });

  
  

  


