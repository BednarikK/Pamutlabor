<tr>
    <td class="m-0 p-0 border">
        <div class="row">
            <h5 class="col-12 col-md-8 ml-3 mt-3">
                <?=$projectsData['title']?>
            </h5>
            <h6 class="col-12 col-md-3 mt-3 ml-3 ml-md-0 text-md-right">
                <?=$projectsData['status']?>
            </h6>
        </div>
        <h6 class="ml-3 mb-3">
            <?=$projectsData['name']?> (<?=$projectsData['email']?>)
        </h6>
        <a href="urlap.php?id=<?=$projectsData['id']?>" class="btn btn-primary ml-3 mb-3">
            Szerkesztés
        </a>
        <a href="components/delete.php?id=<?=$projectsData['id']?>" class="btn btn-danger ml-1 mb-3">
            Törlés
        </a>
    </td>
</tr>