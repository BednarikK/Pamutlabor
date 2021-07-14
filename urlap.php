<?php
    require_once 'components/database.php';
    require_once 'components/htmltop.php';
    require_once 'components/navbar.php';

if(!empty($_GET)) {
    $id = $_GET['id'];
    $sqlUpdate = "
    SELECT
        projects.id, projects.title, projects.description, statuses.name AS 'status', owners.name, owners.email
    FROM
        projects, project_status_pivot, statuses, project_owner_pivot, owners
    WHERE
        projects.id=project_status_pivot.project_id AND
        project_status_pivot.status_id=statuses.id AND
        projects.id=project_owner_pivot.project_id AND
        project_owner_pivot.owner_id=owners.id AND
        projects.id='$id';";
    $updateResult = mysqli_query($dbcon, $sqlUpdate);
    $updateData = mysqli_fetch_assoc($updateResult);
?>

<div class="container">
    <div class="row">
        <div>
            <form class="col-10" action="components/edit.php?id=<?=$id?>" method="post">
                <label class="col-12">Cím</label>
                <input class="col-12 mb-3" type="text" name="title" value="<?=$updateData['title']?>" required>

                <label class="col-12">Leírás</label>
                <input class="col-12 mb-3" type="text" name="description" value="<?=$updateData['description']?>" required>

                <label class="col-12">Státusz</label>
                <select class="mb-3" name="status" value="" required>
                    <?php
                    $sql_statuses_name = "SELECT name FROM statuses";
                    $result_statuses_name = mysqli_query($dbcon, $sql_statuses_name);
                    while($status_name_data = mysqli_fetch_assoc($result_statuses_name)) {
                        ?>
                        <option value="<?=$status_name_data['name']?>">
                            <?=$status_name_data['name']?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

                <label class="col-12">Kapcsolattartó neve</label>
                <input class="col-12 mb-3" type="text" name="name" value="<?=$updateData['name']?>" required>

                <label class="col-12">Kapcsolattartó e-mail címe</label>
                <input class="col-12 mb-3" type="email" name="email" value="<?=$updateData['email']?>" required>

                <button class="d-block btn btn-primary" type="submit" name="insert">Mentés</button>
            </form>
        </div>
    </div>
</div>
    <?php
} else {
    ?>
<div class="container">
    <div class="row">
        <div>
            <form class="col-10" action="php/insert.php" method="post">
                <label class="col-12">Cím</label>
                <input class="col-12 mb-3" type="text" name="title" required>

                <label class="col-12">Leírás</label>
                <input class="col-12 mb-3" type="text" name="description" required>

                <label class="col-12">Státusz</label>
                <select class="mb-3" name="status" required>
                    <?php
                    $sql_statuses_name = "SELECT name FROM statuses";
                    $result_statuses_name = mysqli_query($dbcon, $sql_statuses_name);
                    while($status_name_data = mysqli_fetch_assoc($result_statuses_name)) {
                        ?>
                        <option value="<?=$status_name_data['name']?>">
                            <?=$status_name_data['name']?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

                <label class="col-12">Kapcsolattartó neve</label>
                <input class="col-12 mb-3" type="text" name="name" required>

                <label class="col-12">Kapcsolattartó e-mail címe</label>
                <input class="col-12 mb-3" type="email" name="email" required>

                <button class="d-block btn btn-primary" type="submit" name="insert">Mentés</button>
            </form>
        </div>
    </div>
</div>
<?php
}
    require_once 'components/htmlbottom.php';
?>