<form action="" method="post" class="form mt-3 mx-auto w-50">
    <h4>Add Lecturer</h4>
    <input value="<?=get_var('name') ?>" autofocus class="form-control" type="text" name="name" placeholder="Lecturer Name">
    <button class="btn btn-primary mt-2 float-end" name="search">Search</button>
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers"">
    <button class="btn btn-danger mt-2" type="button">Cancel</button>
    </a>
    <div class="clearfix"></div>
</form>

<div class="container-fluid">
    <?php if (isset($results) && $results) { ?>
        <table class="table table-striped table-hover">
            <tr>
                <th>Lecturer name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($results as $user) { ?>
                <td><?= $user->first_name ?> <?= $user->last_name ?></td>
                <td>
                    <button class="btn btn-sm btn-danger">ADD</button>
                </td>
            <?php } ?>
        </table>
    <?php } else { ?>
        <?php if (count($_POST) > 0) { ?>
            <h4 class="text-center">
                <hr>
                No results were found !
            </h4>
        <?php }
    } ?>
</div>