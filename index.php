<?php require "config/db.php" ?>;

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
    <title>Home</title>
    <style>
    .fit-image img {
        object-fit: contain;
        width: 100%;
        height: 100px; 
    }
</style>
</head>
<body>


<div class="container">
<div class="row">
        <div class="col">
            <h1>Pet List</h1>
        </div>
        <div class="col text-right">
            <a href="addform.php" class="btn btn-primary">Add Data</a>
        </div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Image</th>
          <th class="text-center">Pet Name</th>
          <th class="text-center">Owner Name</th>
          <th class="text-center">Species</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php

       
        $sql = "SELECT pet_id, s_id, pet_name, owner_name, img FROM pet_info";
        $result = mysqli_query($conn, $sql);

      
        while ($row = mysqli_fetch_assoc($result)) {
         
          $speciesSql = "SELECT species_name FROM species WHERE s_id = '{$row['s_id']}'";
          $speciesResult = mysqli_query($conn, $speciesSql);
          $speciesRow = mysqli_fetch_assoc($speciesResult);
          $speciesName = $speciesRow['species_name'];

          
          echo "<tr>";
          echo "<td class='text-center'>{$row['pet_id']}</td>";
          echo "<td class='text-center'><img src='uploads/{$row['img']}' alt='Pet Image' height='100'></td>";
          echo "<td class='text-center'>{$row['pet_name']}</td>";
          echo "<td class='text-center'>{$row['owner_name']}</td>";
          echo "<td class='text-center'>{$speciesName}</td>";
          echo "<td class='text-center'>

          <a href='view.php?pet_id={$row['pet_id']}' class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a>
          <a href='editform.php?pet_id={$row['pet_id']}' class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></a>
          <a href='delete.php?pet_id={$row['pet_id']}' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>

                </td>";
          echo "</tr>";
        }

        
        mysqli_close($conn);
        ?>

      </tbody>
    </table>
  </div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
</html>