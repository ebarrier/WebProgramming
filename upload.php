<html>
    <body>
        <!--Without "multipart/form-data", only the file name would be uploaded, not the file itself-->
        <form method="post" enctype="multipart/form-data"> <!--once this enctype is enabled, php enables the variable $_FILES -->
            <input type="file" name="image"/>
            <input type="submit"/>
        </form>
        <!-- to allow the webapp to store the file on webserver, we need to: mkdir uploads; chmod 777 -->
        <?php
        copy($_FILES["image"]["tmp_name"],
        "uploads/" . $_FILES["image"]["name"]);
        //add the connection to db and insert rown to product table
        ?>
        <p>Filename was: <?=$checksum;?>
        <p>File stored at
    </body>
</html>

