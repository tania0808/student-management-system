<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


    <div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
        <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
        <?php if($row) :?>
        <div class="row d-flex justify-content-center px-5">
            <h4 class="text-center mb-3"><?=ucwords(escape($row->class_name))?></h4>

            <table class="table table-hover table-striped table-light table-bordered">
                    <tr>
                        <th>Class name:</th>
                        <td><?=escape($row->class_name)?></td>
                    </tr>
                    <tr>
                        <th>Created by :</th>
                        <td><?=escape($row->user->first_name)?> <?=escape($row->user->last_name)?></td>
                    </tr>
                    <tr>
                        <th>Date Created:</th>
                        <td><?=escape(get_date($row->date))?></td>
                    </tr>
                </table>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?=$page_tab == 'lecturers' ? 'active' : ''; ?>" href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=lecturers">Lecturers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$page_tab == 'students' ? 'active' : ''; ?>" href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=students">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$page_tab == 'tests' ? 'active' : ''; ?>" href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">Tests</a>
                </li>
            </ul>

            <?php
            switch ($page_tab){
                case 'lecturers':
                    include ($this->views_path('class-tab-lecturers'));
                    break;

                case 'students':
                    include($this->views_path('class-tab-students'));
                    break;

                case 'tests':
                    include($this->views_path('class-tab-tests'));
                    break;

                case 'lecturers_add':
                    include($this->views_path('class-tab-lecturers-add'));
                    break;


                case 'students_add':
                    include($this->views_path('class-tab-students-add'));
                    break;


                case 'tests_add':
                    include($this->views_path('class-tab-tests-add'));
                    break;


                default:
            }
            ?>
        </div>
        <?php else :?>
        <h3 class="text-center">That profile was not found !</h3>
        <?php endif;?>
    </div>


<?php $this->view('includes/footer'); ?>