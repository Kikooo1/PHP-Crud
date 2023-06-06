<!DOCTYPE html>
<html>
<head>
    <title>View Pet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .pet-image {
            max-width: 200px;
            max-height: 200px;
        }
        .modal-header {
            background-color: #007bff;
            color: #fff;
        }
        .modal-footer {
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
  
    <div class="row align-items-center">
        <div class="col">
            <h2 class="d-inline-block">View Pet</h2>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#showHistoryModal" data-petid="<?php echo $petId; ?>">Show History</a>
        </div>
    </div>



        <?php
        require "config/db.php";

        // Get the pet_id from the query string
        if (isset($_GET['pet_id'])) {
            $petId = mysqli_real_escape_string($conn, $_GET['pet_id']);

            // Fetch data from the pet_info table including the species name from the species table for the specified pet_id
            $query = "SELECT pet_info.pet_id, species.species_name, pet_info.pet_name, pet_info.owner_name, pet_info.img FROM pet_info INNER JOIN species ON pet_info.s_id = species.s_id WHERE pet_info.pet_id = '$petId'";
            $result = mysqli_query($conn, $query);

            // Check if pet with the given pet_id exists
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $species = $row['species_name'];
                $petName = $row['pet_name'];
                $ownerName = $row['owner_name'];
                $imagePath = 'uploads/' . $row['img']; // Update the image path
        ?>

                <div class="row">
                    <div class="col-12 col-md-4">
                        <img src="<?php echo $imagePath; ?>" alt="Pet Image" class="pet-image img-thumbnail">
                    </div>
                    <div class="col-12 col-md-8">
                        <h4>Pet ID: <?php echo $petId; ?></h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Species</th>
                                <td><?php echo $species; ?></td>
                            </tr>
                            <tr>
                                <th>Pet Name</th>
                                <td><?php echo $petName; ?></td>
                            </tr>
                            <tr>
                                <th>Owner Name</th>
                                <td><?php echo $ownerName; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

        <?php
            } else {
                echo "<p>No pet found with the given ID.</p>";
            }
        } else {
            echo "<p>Invalid pet ID.</p>";
        }
        ?>

<div class = "row">
  <div class = "col">
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addVaccineModal" data-petid="<?php echo $petId; ?>">Add Vaccine</button>
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addHistory" data-petid="<?php echo $petId; ?>">Add Visit Details</button>
  </div>
</div>
       


    </div>

    <!-- Add Vaccine Modal -->
    <div id="addVaccineModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="addvaccine.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Add Vaccine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="pet_id" value="<?php echo $petId; ?>">
              <div class="form-group">
                <label>Select Vaccine:</label>
                <select class="form-control" name="vaccine">
                  <?php
                  $vaccineQuery = "SELECT * FROM vaccine";
                  $vaccineResult = mysqli_query($conn, $vaccineQuery);
                  while ($vaccineRow = mysqli_fetch_assoc($vaccineResult)) {
                    $vaccineId = $vaccineRow['vac_id'];
                    $vaccineName = $vaccineRow['vaccine_name'];
                    echo "<option value='$vaccineId'>$vaccineName</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Add History Modal -->
    <div id="addHistory" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="addHistory.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Visit Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="pet_id" value="<?php echo $petId; ?>">
              <div class="form-group">
                <label>Reason of Visit:</label>
                <select class="form-control" name="rov">
                  <?php
                  $rovQuery = "SELECT * FROM reason_of_visit";
                  $rovResult = mysqli_query($conn, $rovQuery);
                  while ($rovRow = mysqli_fetch_assoc($rovResult)) {
                    $rovId = $rovRow['rov_id'];
                    $rovName = $rovRow['reason'];
                    echo "<option value='$rovId'>$rovName</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
               <label>Weight (in kg):</label>
               <input type="number" step="0.01" class="form-control" name="weight" required>
               </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

<!-- Show History Modal -->
<div id="showHistoryModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">History</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>History ID</th>
              <th>Pet Name</th>
              <th>Weight (kg)</th>
              <th>Reason of Visit</th>
              <th>Date Visited</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Get the pet_id from the query string
            if (isset($_GET['pet_id'])) {
              $petId = mysqli_real_escape_string($conn, $_GET['pet_id']);

              $historyQuery = "SELECT history.hist_id, pet_info.pet_name, history.weight_kg, reason_of_visit.reason, history.date_visited FROM history INNER JOIN pet_info ON history.pet_id = pet_info.pet_id INNER JOIN reason_of_visit ON history.rov_id = reason_of_visit.rov_id WHERE history.pet_id = '$petId'";
              $historyResult = mysqli_query($conn, $historyQuery);
              while ($historyRow = mysqli_fetch_assoc($historyResult)) {
                $historyId = $historyRow['hist_id'];
                $petName = $historyRow['pet_name'];
                $weight = $historyRow['weight_kg'];
                $reason = $historyRow['reason'];
                $dateVisited = $historyRow['date_visited'];

                echo "<tr>";
                echo "<td>$historyId</td>";
                echo "<td>$petName</td>";
                echo "<td>$weight</td>";
                echo "<td>$reason</td>";
                echo "<td>$dateVisited</td>";
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
