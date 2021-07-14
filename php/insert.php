<?php
    if(isset($_POST['insert'])) {
        if(
            isset($_POST['title']) && 
            isset($_POST['description']) && 
            isset($_POST['status']) && 
            isset($_POST['name']) && 
            isset($_POST['email'])
        ) {
            require_once '../components/database.php';

            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            
            $sqlProjects = "
            INSERT INTO projects(title, description)
            VALUES ('$title', '$description');";
            $sqlprojectstatuspivot = "
            INSERT INTO project_status_pivot(project_id, status_id)
            VALUES ((SELECT id FROM projects WHERE title='$title'), (SELECT id FROM statuses WHERE name='$status'));";

            mysqli_query($dbcon, $sqlProjects);
            mysqli_query($dbcon, $sqlprojectstatuspivot);

            $ownerIdQuery = "SELECT id FROM owners WHERE name='$name';";
            $ownerId = mysqli_query($dbcon, $ownerIdQuery);

            if($ownerId != NULL) {
                $sqlNewOwner = "INSERT INTO owners(name, email)
                VALUES ('$name', '$email');";
                mysqli_query($dbcon, $sqlNewOwner);
                $sqlprojectownerpivotwithnewuser = "INSERT INTO project_owner_pivot(project_id, owner_id)
                VALUES((SELECT id FROM projects WHERE title='$title'),(SELECT id FROM owners WHERE name='$name'));";
                mysqli_query($dbcon, $sqlprojectownerpivotwithnewuser);
            } else { 
                $sqlprojectownerpivotexistinguser = "
                INSERT INTO project_owner_pivot(project_id, owner_id)
                VALUES ((SELECT id FROM projects WHERE title='$title'), $ownerId);";
                mysqli_query($dbcon, $sqlprojectownerpivotexistinguser);
            }
        }
    }
    header('Location: ../index.php');
?>