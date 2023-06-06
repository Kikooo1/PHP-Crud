<?php

require "config/db.php";

if(isset($_POST['submit'])) {
    $petId = $_POST['petId'];
    $petName = mysqli_real_escape_string($conn, $_POST['petName']);
    $ownerName = mysqli_real_escape_string($conn, $_POST['ownerName']);
    $species = mysqli_real_escape_string($conn, $_POST['s_id']);

   
    if($_FILES["image"]["error"] === 4) {
    
        $query = "UPDATE pet_info SET s_id = '$species', pet_name = '$petName', owner_name = '$ownerName' WHERE pet_id = '$petId'";
    }
    else {
        
        $filename = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension'); </script>";
            
            exit;
        }
        else if($filesize > 1000000) {
            echo "<script>alert('Image Size Is Too Large'); </script>";
            
            exit;
        }

        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;

        move_uploaded_file($tmpName, 'uploads/' . $newImageName);

        $query = "UPDATE pet_info SET s_id = '$species', pet_name = '$petName', owner_name = '$ownerName', img = '$newImageName' WHERE pet_id = '$petId'";
    }

    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Successfully Updated'); document.location.href='index.php'</script>";
    }
    else {
        echo "Error updating record: " . mysqli_error($conn);
       
    }
}

?>
