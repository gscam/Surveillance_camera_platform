<?php
  $id = $_GET['id'];

  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];

  $total = count($fileName);
  for( $i=0 ; $i < $total ; $i++ ) {
    $file = $_FILES['file'][$i];
    $fileName = $_FILES['file']['name'][$i];
    $fileTmpName = $_FILES['file']['tmp_name'][$i];
    $fileSize = $_FILES['file']['size'][$i];
    $fileError = $_FILES['file']['error'][$i];
    $fileType = $_FILES['file']['type'][$i];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)){
        if ($fileError == 0){
            if ($fileSize < 5000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                if (!file_exists('enter_exit'.$id.'/'.$_POST["name"])) {
                    mkdir('enter_exit'.$id.'/'.$_POST["name"], 0777, true);
                }
                $fileDestination = 'enter_exit'.$id.'/'.$_POST["name"].'/'.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: enter_exit.php?uploadsuccess");
            } else{
                echo "Your file is too big.";
            }
        }else{
            echo "There was an error uploading your file.";
        }
    } else{
        echo "You cannot upload files of this type.";
    }
  }

  header("Location: /enter_exit.php?id=".$id);
?>