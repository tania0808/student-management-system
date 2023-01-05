<?php

class Profile extends Controller
{
    function index($id = '')
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $user = new User();
        $id = trim($id == '') ? Auth::getStudent_id() : $id;

        $row = $user->first('student_id', $id);
        $crumbs[] = ['Dashboard', ROOT . '/'];
        if ($row) {
            $crumbs[] = ['Profile', ROOT . '/profile/' . $row->student_id];
            $crumbs[] = [$row->first_name, ROOT . ''];
        }

        $data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'infos';

        if ($data['page_tab'] == 'classes') {
            $class = new Classe();

            if ($row->rank == 'student') {

                $student = new Student();
                $query = "SELECT * FROM students WHERE user_id = :user_id && disabled = 0";
                $data['stud_classes'] = $student->query($query, ['user_id' => $id]);

                $data['student_classes'] = [];

                if ($data['stud_classes']) {
                    foreach ($data['stud_classes'] as $key => $value) {
                        $data['student_classes'][] = $class->first('class_id', $value->class_id);
                    }
                }
            } else {
                $lecturer = new Lecturer();
                $query = "SELECT * FROM lecturers WHERE user_id = :user_id && disabled = 0";
                $data['lect_classes'] = $lecturer->query($query, ['user_id' => $id]);
                $data['lecturer_classes'] = [];

                if ($data['lect_classes']) {
                    foreach ($data['lect_classes'] as $key => $value) {
                        $data['lecturer_classes'][] = $class->first('class_id', $value->class_id);
                    }
                }
            }
        }
        $data['user'] = $row;
        $data['crumbs'] = $crumbs;
        $data['id'] = $id;
        if (Auth::access('reception') || Auth::i_own_content($row)) {
            $this->view('profile', $data);
        } else {
            $this->view('access-denied');
        }

    }

    function edit($id = "")
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $user = new User();
        $id = trim($id == '') ? Auth::getStudent_id() : $id;

        $row = $user->first('student_id', $id);

        $data['user'] = $row;
        $data['id'] = $id;
        $errors = [];

        if (count($_POST) > 0 && Auth::access('reception')) {
            if (trim($_POST['password'] == '')) {
                unset($_POST['password']);
                unset($_POST['password2']);
            }
            if ($user->validate($_POST, $id)) {
                // check for files
                if(count($_FILES) > 0){
                    $allowed = ['image/jpeg', 'image/png'];
                    if($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)){
                        $folder = 'uploads/';
                        if(!file_exists($folder)){
                            mkdir($folder, 0777, true);
                        }
                        $destination = $folder . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                        $_POST['image'] = $destination;
                    }
                }

                if ($_POST['rank'] == 'super_admin' && $_SESSION['USER']->rank != 'super_admin') {
                    $_POST['rank'] == 'admin';
                }
                $user->update($row->id, $_POST);
                $this->redirect("profile/edit/$id");
            } else {
                // errors
                $data['errors'] = $user->errors;
            }
        }

        if (Auth::access('reception') || Auth::i_own_content($row)) {
            $this->view('profile-edit', $data);
        } else {
            $this->view('access-denied');
        }
    }

    function delete()
    {

    }
}
