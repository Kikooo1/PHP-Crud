<?php

require "config/db.php";

if (isset($_POST['submit'])) {
  $petId = mysqli_real_escape_string($conn, $_POST['pet_id']);
  $rovId = mysqli_real_escape_string($conn, $_POST['rov']);
  $weight = mysqli_real_escape_string($conn, $_POST['weight']);


  $sql = "INSERT INTO history (pet_id, weight_kg, rov_id, date_visited) VALUES ('$petId', '$weight', '$rovId', NOW())";
  if (mysqli_query($conn, $sql)) {
    
    mysqli_close($conn);

    
    header("Location: view.php?pet_id=$petId");
    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}


mysqli_close($conn);
?>