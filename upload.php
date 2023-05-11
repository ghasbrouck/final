<?php
    if(isset($_POST['submit'])) {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedExt = array('jgp', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowedExt)) {
            if($fileError === 0) {
                if($fileSize < 1000000) {
                    $fileNewName = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: gallery.html?uploadsuccess");
                } else {
                    echo "Stop!!! That file is way too big";
                }
            } else {
                echo "Oopsies. Something went wrong";
            }
        } else {
            echo "Files must be jpg, jpeg, and png";
        }
    }