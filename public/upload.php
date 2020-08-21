<form enctype="multipart/form-data" method="post">

    <input type="file" name="bestand" />

    <input type="submit">

</form>


<?php
if(isset($_FILES['bestand'])) {
    var_dump($_FILES['bestand']);
}


$dir = 'public';
$name = 'holiday.png';

$name = '../config/packages/security.yml';

echo $dir . '/' . $name;

dirname('../config/packages/security.yml');//../config/packages/
basename('../config/packages/security.yml');//security.yml

move_uploaded_file($_FILES['bestand']['tmp_name'], $dir . md5($_FILES['bestand']['name']) . '.txt');