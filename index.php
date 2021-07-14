<?php
    require_once 'components/database.php';
    require_once 'components/htmltop.php';
    require_once 'components/navbar.php';
?>

<div class="container mb-3">
    <div class="row">

        <div class="text-center text-md-left col-12 col-lg-3 h-100 p-0 mr-4 bg-light shadow">
            <h5 class="p-2 pl-3 bg-dark text-light">Státuszok</h5>
            <form method="get">
                <?php
                $sql_statuses = "SELECT name, id FROM statuses;";
                $result_statuses = mysqli_query($dbcon, $sql_statuses);

                foreach($result_statuses as $statusName) {
                    ?>
                    <div class="pl-3">
                        <label><?=$statusName['name']?></label>
                        <input type="checkbox" name="<?=$statusName['name']?>" value="<?=$statusName['id']?>">
                    </div>
                <?php
                }
                ?>
                <button class="btn btn-secondary ml-3 mb-3" type="submit" value="filter">Keresés</button>
            </form>
        </div>

        <div class="col-12 col-lg-8 p-0">
            <table class="col-12 m-0 bg-light shadow">
                <?php
                if(!empty($_GET)) {
                    foreach($_GET as $statusIndex) {
                        $sql_projects = "
                        SELECT
                            projects.id, projects.title, projects.description, statuses.name AS 'status', owners.name, owners.email
                        FROM
                            projects, project_status_pivot, statuses, project_owner_pivot, owners
                        WHERE
                            projects.id=project_status_pivot.project_id AND
                            project_status_pivot.status_id=statuses.id AND
                            projects.id=project_owner_pivot.project_id AND
                            project_owner_pivot.owner_id=owners.id AND
                            statuses.id='$statusIndex';";
                        $result_projects = mysqli_query($dbcon, $sql_projects);
                    
                        while($projectsData = mysqli_fetch_assoc($result_projects)) {
                            require 'components/project.php';
                        }
                    }
                } else {
                    $sql_projects = "
                    SELECT
                        projects.id, projects.title, projects.description, statuses.name AS 'status', owners.name, owners.email
                    FROM
                        projects, project_status_pivot, statuses, project_owner_pivot, owners
                    WHERE
                        projects.id=project_status_pivot.project_id AND
                        project_status_pivot.status_id=statuses.id AND
                        projects.id=project_owner_pivot.project_id AND
                        project_owner_pivot.owner_id=owners.id";
                    $result_projects = mysqli_query($dbcon, $sql_projects);

                    while($projectsData = mysqli_fetch_assoc($result_projects)) {
                        require 'components/project.php';
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
require_once 'components/htmlbottom.php';
?>