<?php
include 'conection.php';  
include 'crud.php';  

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);  
    deleteData($id);  
}

header("Location: index.php"); 
exit();
?>
