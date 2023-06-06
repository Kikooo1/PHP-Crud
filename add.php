<?php

require "config/db.php";

if(isset($_POST['submit'])){

    $petName = mysqli_real_escape_string($conn, $_POST['petName']);
    $ownerName = mysqli_real_escape_string($conn, $_POST['ownerName']);
    $species = mysqli_real_escape_string($conn, $_POST['s_id']);


    if($_FILES["image"]["error"] === 4){
        echo "<script>alert('Image Does Not Exist'); </script>";
    }
    else{
        $filename = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validImageExtension)){
            echo "<script>alert('Invalid Image Extension'); </script>";
        }
        else if($filesize > 1000000){
            echo "<script>alert('Image Size Is Too Large'); </script>";
        }
        else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'uploads/' . $newImageName);
            $query = "INSERT INTO pet_info (s_id, pet_name, owner_name, img) VALUES ('$species', '$petName', '$ownerName', '$newImageName')";
            mysqli_query($conn, $query);
            echo "<script>alert('Successfully Added'); document.location.href='index.php'</script>";
            
        }
        


    }


}







?>