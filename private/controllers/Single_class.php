<?php

class Single_class extends Controller
{
    public function index($id = '')
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $classes = new Classe();
        $row = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if ($row) {
            $crumbs[] = [$row->class_name, ROOT . ''];
        }

        $limit = 1;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $lecturer = new Lecturer();
        $results = false;
        $error = '';

        if ($page_tab == 'lecturers') {
            // display lecturers
            $query = "SELECT * FROM lecturers WHERE disabled = 0 && class_id = :class_id LIMIT $limit offset $offset";
            $lecturers = $lecturer->query($query, ['class_id' => $id]);
            $data['lecturers'] = $lecturers;
        } elseif ($page_tab == 'students') {
            // display students
            $query = "SELECT * FROM students WHERE disabled = 0 && class_id = :class_id LIMIT $limit offset $offset";
            $students = $lecturer->query($query, ['class_id' => $id]);
            $data['students'] = $students;
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;
        $data['pager'] = $pager;

        $this->view('single_class', $data);
    }

    public function lectureradd($id = "")
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $classes = new Classe();
        $class = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if ($class) {
            $crumbs[] = [$class->class_name, ROOT . ''];
        }
        $page_tab = 'lectureradd';
        $lecturer = new Lecturer();
        $results = false;
        $error = '';

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                // find lecturer
                $user = new User();
                if (trim($_POST['name']) == '') {
                    $error = 'Enter user name !!!';
                } else {
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'lecturer' LIMIT 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                }
            } else if (isset($_POST['select'])) {
                // add lecturer
                $query = "SELECT * FROM lecturers WHERE user_id = :user_id && class_id = :class_id LIMIT 10";
                $user_id = $_POST['select'];
                $row = $lecturer->query($query, [
                    'user_id' => $user_id,
                    'class_id' => $id
                ]);
                if (!$row) {
                    $arr = [];
                    $arr['user_id'] = $user_id;
                    $arr['class_id'] = $id;
                    $arr['disabled'] = 0;
                    $arr['date'] = date("y-m-d h:i:s");
                    $lecturer->insert($arr);
                    $this->redirect("single_class/$id?tab=lecturers");
                } else {
                    if ($row[0]->disabled && $row[0]->disabled == 1) {
                        $arr = [];
                        $arr['disabled'] = 0;
                        $row = $row[0];
                        $lecturer->update($row->id, $arr);
                        $this->redirect("single_class/$id?tab=lecturers");
                    }
                    else {
                        $error = 'User already exists !';
                    }

                }
            }
        }

        $data['row'] = $class;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;

        $this->view('single_class', $data);
    }


    public function lecturerremove($id = "")
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $classes = new Classe();
        $class = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if ($class) {
            $crumbs[] = [$class->class_name, ROOT . ''];
        }
        $page_tab = 'lecturerremove';
        $lecturer = new Lecturer();
        $results = false;
        $error = '';

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                // find lecturer
                $user = new User();
                if (trim($_POST['name']) == '') {
                    $error = 'Enter user name !!!';
                } else {
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'lecturer' LIMIT 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                }
            }

            if (isset($_POST['select'])) {
                // remove lecturer
                $query = "SELECT id FROM lecturers WHERE user_id = :user_id && class_id = :class_id && disabled = 0 LIMIT 10";

                $row = $lecturer->query($query, [
                    'user_id' => $_POST['select'],
                    'class_id' => $id
                ]);
                if (is_array($row)) {
                    $arr = [];
                    $arr['disabled'] = 1;
                    $lecturer->update($row[0]->id, $arr);
                    $this->redirect("single_class/$id?tab=lecturers");
                } else {
                    $error = "User doesn't belongs to this class, so you can't remove it !!!";
                }
            }
        }

        $data['class'] = $row;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;

        $this->view('single_class', $data);
    }

    public function studentadd($id = "")
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $classes = new Classe();
        $class = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if ($class) {
            $crumbs[] = [$class->class_name, ROOT . ''];
        }
        $page_tab = 'studentadd';
        $student = new Student();
        $results = false;
        $error = '';

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                // find lecturer
                $user = new User();
                if (trim($_POST['name']) == '') {
                    $error = 'Enter user name !!!';
                } else {
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'student' LIMIT 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                }
            }

            if (isset($_POST['select'])) {
                // add student
                $query = "SELECT * FROM students WHERE user_id = :user_id && class_id = :class_id LIMIT 10";
                $user_id = $_POST['select'];
                $row = $student->query($query, [
                    'user_id' => $user_id,
                    'class_id' => $id
                ]);
                if (!$row) {
                    $arr = [];
                    $arr['user_id'] = $user_id;
                    $arr['class_id'] = $id;
                    $arr['disabled'] = 0;
                    $arr['date'] = date("y-m-d h:i:s");
                    $student->insert($arr);
                    $this->redirect("single_class/$id?tab=students");
                } else {
                    if ($row[0]->disabled && $row[0]->disabled == 1) {
                        $arr = [];
                        $arr['disabled'] = 0;
                        $student->update($row[0]->id, $arr);
                        $this->redirect("single_class/$id?tab=students");
                    } else {
                        $error = 'User already exists !';
                    }
                }
            }
        }

        $data['row'] = $class;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;

        $this->view('single_class', $data);
    }

    public function studentremove($id = "")
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $classes = new Classe();
        $row = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if ($row) {
            $crumbs[] = [$row->class_name, ROOT . ''];
        }
        $page_tab = 'studentremove';
        $student = new Student();
        $results = false;
        $error = '';

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                // find student
                $user = new User();
                if (trim($_POST['name']) == '') {
                    $error = 'Enter user name !!!';
                } else {
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'student' LIMIT 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                }
            }

            if (isset($_POST['select'])) {
                // remove student
                $query = "SELECT id FROM students WHERE user_id = :user_id && class_id = :class_id && disabled = 0 LIMIT 10";

                $row = $student->query($query, [
                    'user_id' => $_POST['select'],
                    'class_id' => $id
                ]);
                if (is_array($row)) {
                    $arr = [];
                    $arr['disabled'] = 1;
                    $student->update($row[0]->id, $arr);
                    $this->redirect("single_class/$id?tab=students");
                } else {
                    $error = "User doesn't belongs to this class, so you can't remove it !!!";
                }
            }
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;

        $this->view('single_class', $data);
    }
}
