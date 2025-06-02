<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $t=time();
    echo($t . "<br>");
    echo(date("Y-m-d",$t));
    
    ?>
    <form action="" enctype="multipart/form-data" method="post">
        <input type="text" name="nome" />
        <input type="file" name="arquivo" id="" />
        <input type="submit" value="enviar" />
    </form>
<?php
    //https://www.w3schools.com/php/php_file_upload.asp
if(isset($_POST['nome'])){
    $target_dir = "uploads/";
    $target_file = $target_dir."".$t . basename($_FILES["arquivo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //
    $check = getimagesize($_FILES["arquivo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
  
    // Check file size
    if ($_FILES["arquivo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
  
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
  
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])).
             " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
    
?>
</body>

</html>