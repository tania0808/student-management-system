<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>
<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <div class="card-group justify-content-center">
        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Class name</th>
                <th>Created by</th>
                <th>Created at</th>
                <th>
                    <a href="<?=ROOT?>/classes/add">
                        <button class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>Add new</button>
                    </a>
                </th>

            </tr>

            <?php
            if($classes){
            foreach ($classes as $class) {?>
                <tr>
                    <td>
                        <a href="<?=ROOT?>/single_class/<?=$class->class_id ?>">
                            <button class="btn btn-sm btn-info text-white">Details<i class="fa-solid fa-chevron-right ms-2"></i></button>
                        </a>
                    </td>
                    <td><?=$class->class_name?></td>
                    <td><?=$class->user->first_name?> <?=$class->user->last_name?></td>
                    <td><?=get_date($class->date)?></td>
                    <td>
                        <a href="<?=ROOT?>/classes/edit/<?=$class->id?>">
                            <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit me-2"></i>Edit</button>
                        </a>
                        <a href="<?=ROOT?>/classes/delete/<?=$class->id?>">
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                        </a>
                    </td>
                </tr>

            <?php }} else {
                echo "No classes were found at this time";
            }?>
        </table>
    </div>
</div>

<?php $this->view('includes/footer'); ?>
