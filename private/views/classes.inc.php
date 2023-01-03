<table class="table table-striped table-hover mt-2">
    <tr>
        <th></th>
        <th>Class name</th>
        <th>Created by</th>
        <th>Created at</th>
        <th>

        </th>

    </tr>

    <?php if(is_array($classes)) {
        foreach ($classes as $class) { ?>
            <tr>
                <td>
                    <a href="<?= ROOT ?>/single_class/<?= $class->class_id ?>">
                        <button class="btn btn-sm btn-info text-white">Details<i
                                    class="fa-solid fa-chevron-right ms-2"></i></button>
                    </a>
                </td>
                <td><?= $class->class_name ?></td>
                <td><?= $class->user->first_name ?> <?= $class->user->last_name ?></td>
                <td><?= get_date($class->date) ?></td>
                <td>
                    <?php if(Auth::access('lecturer')): ?>
                    <a href="<?= ROOT ?>/classes/edit/<?= $class->id ?>">
                        <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit me-2"></i>Edit</button>
                    </a>
                    <a href="<?= ROOT ?>/classes/delete/<?= $class->id ?>">
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                    </a>
                    <?php endif;?>
                </td>
            </tr>

        <?php }
    } else {
        echo "<h4>No classes were found at this time</h4>";
    } ?>
</table>