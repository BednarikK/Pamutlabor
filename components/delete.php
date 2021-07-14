<?php
    require_once 'database.php';
    $id = $_GET['id'];

    $deleteOwner = "DELETE FROM project_owner_pivot WHERE project_id='$id';";
    $deleteStatus = "DELETE FROM project_status_pivot WHERE project_id='$id';";
    $deleteProject = "DELETE FROM projects WHERE id='$id';";
    mysqli_query($dbcon, $deleteOwner);
    mysqli_query($dbcon, $deleteStatus);
    mysqli_query($dbcon, $deleteProject);

    header('Location: ../index.php');
?>