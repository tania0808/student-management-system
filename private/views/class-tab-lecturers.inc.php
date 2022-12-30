<div class="d-flex justify-content-between align-items-center">
    <div class="input-group flex-nowrap mt-3 w-25 mb-3">
        <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
               aria-describedby="addon-wrapping">
    </div>
    <div>
        <a href="<?= ROOT ?>/single_class/lectureradd/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>Add New</button>
        </a>
        <a href="<?= ROOT ?>/single_class/lecturerremove/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-danger"><i class="fa fa-minus me-2"></i>Remove</button>
        </a>
    </div>

</div>
<div class="card-group">
    <?php
    if (is_array($lecturers)) {
        foreach ($lecturers as $user) {
            $user = $user->user; ?>
            <?php include($this->views_path('user')); ?>
        <?php }
    } ?>
</div>

