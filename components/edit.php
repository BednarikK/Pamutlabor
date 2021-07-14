<?php
    require_once 'database.php';

    $id = $_GET['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sqlUpdateProject = "
    UPDATE projects 
    SET title='$title', description='$description' 
    WHERE id='$id';";
    mysqli_query($dbcon, $sqlUpdateProject);

    $sqlUpdateStatus = "
    UPDATE project_status_pivot 
    SET status_id=(SELECT id FROM statuses WHERE name='$status') 
    WHERE project_id='$id';";
    mysqli_query($dbcon, $sqlUpdateStatus);

    /* $sqlNewOwner = "INSERT INTO owners(name, id) VALUES ('$name', '$email');";
    mysqli_query($dbcon, $sqlNewOwner);
    
    $sqlUpdateOwner = "
    UPDATE project_owner_pivot SET owner_id=(SELECT id FROM owners WHERE name='$name') WHERE project_id='$id';";
    mysqli_query($dbcon, $sqlUpdateOwner); */


    header('Location: ../index.php');
?>