<?php

require "config/db.php";

if (isset($_POST['submit'])) {
  $petId = mysqli_real_escape_string($conn, $_POST['pet_id']);
  $vaccineId = mysqli_real_escape_string($conn, $_POST['vaccine']);

  
  $insertSql = "INSERT INTO vaccines_administered (pet_id, vaccine_id) VALUES ('$petId', '$vaccineId')";
  if (mysqli_query($conn, $insertSql)) {
   
    mysqli_close($conn);

   
    header("Location: view.php?pet_id=$petId");
    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}


mysqli_close($conn);
?>
