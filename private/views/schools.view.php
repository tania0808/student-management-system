<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb'); ?>
    <div class="card-group justify-content-center">
        <table class="table table-striped table-hover">
            <tr>
                <th>School</th>
                <th>Created by</th>
                <th>Created at</th>
                <th>
                    <a href="<?=ROOT?>/schools/add">
                        <button class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>Add new</button>
                    </a>
                </th>

            </tr>

            <?php if($schools){
            foreach ($schools as $school) { ?>
                <tr>
                    <td><?=$school->school_name?></td>
                    <td><?=$school->user_id?></td>
                    <td><?=$school->date?></td>
                    <td>
                        <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit me-2"></i>Edit</button>
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                    </td>
                </tr>

            <?php }} else {
                echo "No schools were found at this time";
            }?>
        </table>
    </div>
</div>

<?php $this->view('includes/footer'); ?>
