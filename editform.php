<?php
    require "config/db.php";

    // Check if the pet ID is provided
    if(isset($_GET['pet_id'])) {
        $petId = $_GET['pet_id'];

        // Retrieve the existing pet information
        $query = "SELECT * FROM pet_info WHERE pet_id = '$petId'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $petName = $row['pet_name'];
            $ownerName = $row['owner_name'];
            $speciesId = $row['s_id'];
            $photoPath = $row['img'];

            // Fetch species name based on the species ID
            $speciesSql = "SELECT species_name FROM species WHERE s_id = '$speciesId'";
            $speciesResult = mysqli_query($conn, $speciesSql);
            $speciesName = (mysqli_num_rows($speciesResult) > 0) ? mysqli_fetch_assoc($speciesResult)['species_name'] : 'Unknown';
        }
        else {
            echo "No pet found with the provided ID.";
            exit;
        }
    }
    else {
        echo "No pet ID provided.";
        exit;
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Add Animal</title>
</head>


<body>

    <div class = "container-fluid">
        <div class = "row">

            <div class = "col-lg-4"></div>

                <div class = "col-lg-4">

                    <div class = "card">

                        <div class = "card-header">
                            <h4>Add Animal</h4>
                        </div>

                        <div class = "card-body">
                            <form action="edit.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="petId" value="<?php echo $petId; ?>">

                                <div class = "form-group">
                                    <label>Pet Name</label>
                                    <input type="text" name="petName" class="form-control" value="<?php echo $petName;?>">
                                </div>

                                <div class = "form-group">
                                    <label>Owner Name</label>
                                    <input type="text" name="ownerName" class="form-control" value="<?php echo $ownerName; ?>">
                                </div>
                                
                             
                                <div class = "form-group">
                                    <label>Species</label>
                                    <select class = "form-control" id = "species" required name="s_id">
                                    <option value="">Select Species</option>
                                   
                                    <?php
                                      // Fetch species options from the species table
                                     $speciesQuery = "SELECT * FROM species";
                                     $speciesResult = mysqli_query($conn, $speciesQuery);

                                    while($speciesRow = mysqli_fetch_assoc($speciesResult)) {
                                        $speciesOptionId = $speciesRow['s_id'];
                                        $speciesOptionName = $speciesRow['species_name'];
                                        $selected = ($speciesOptionId == $speciesId) ? 'selected' : '';

                                    echo "<option value='$speciesOptionId' $selected>$speciesOptionName</option>";
                                    }
                                    ?>
                                  </select>
                                </div>

                                <div class = "form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="image" id="image" accept =".jpg, .jpeg, .png" class="form-control">
                                </div>

                                <button type = "submit" name= "submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>


            </div>
                

        </div>
    </div>






  <!-- Include Bootstrap JS (optional) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>