<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USB-LESS</title>
</head>
<body>
    <h1>USB-LESS</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile[]" multiple>
        <button type="submit" name="upload">Upload</button>
    </form>
    <?php
        if (isset($_POST['upload'])){
            if (isset($_FILES['myfile'])) {
                $fileCount = count($_FILES['myfile']['name']);
                $success = 0;
                for ($i = 0; $i < $fileCount; $i++) {
                    if ($_FILES['myfile']['error'][$i] == 0) {
                        $target = "uploads/" . basename($_FILES['myfile']['name'][$i]);
                        if (move_uploaded_file($_FILES['myfile']['tmp_name'][$i], $target)) {
                            $success++;
                        }
                    }
                }
                if ($success > 0) {
                    echo "$success file(s) uploaded successfully!";
                } else {
                    echo "File upload failed!";
                }
            } else {
                echo "No files selected or upload error.";
            }
        }

        // List files in uploads directory
        $dir = 'uploads';
        if (is_dir($dir)){
            $files = array_diff(scandir($dir), array('.', '..'));
            if (count($files) > 0){
                echo "<h2>Uploaded Files:</h2><ul>";
                foreach($files as $file){
                    echo "<li><a href='$dir/$file' target='_blank'>$file</a></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No files uploaded yet.</p>";
            }
        }
    ?>
</body>
</html>