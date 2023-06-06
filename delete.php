<?php 

require("config/db.php");

if (isset($_GET['pet_id'])) {
    $petId = $_GET['pet_id'];
  

    $sql = "DELETE FROM pet_info WHERE pet_id = '$petId'";
    if (mysqli_query($conn, $sql)) {
 
      echo "Pet record deleted successfully.";
    } else {
      
      echo "Error deleting pet record: " . mysqli_error($conn);
    }
  } else {
    
    echo "Invalid request. pet_id not provided.";
  }
  
  
  mysqli_close($conn);
  
  ?>
  
  
  