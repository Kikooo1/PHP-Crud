<?php require "config/db.php";

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
                            <form action="add.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class = "form-group">
                                    <label>Pet Name</label>
                                    <input type="text" name="petName" class="form-control">
                                </div>

                                <div class = "form-group">
                                    <label>Owner Name</label>
                                    <input type="text" name="ownerName" class="form-control">
                                </div>

                                <div class = "form-group">
                                    <label>Species</label>
                                    <select class = "form-control" required name="s_id">
                                    <option value="">Select Species</option>
                                   
                                    <?php

                                    $sql = "SELECT s_id, species_name FROM species";
                                    $result = $conn->query($sql);

                               
                                    if ($result->num_rows > 0) {
                                     while ($row = $result->fetch_assoc()) {
                                        $sId = $row['s_id'];
                                        $speciesName = $row['species_name'];

                                    echo "<option value='$sId'>$speciesName</option>";
                                     }
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






  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>