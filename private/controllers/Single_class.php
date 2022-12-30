<?php

class Single_class extends Controller
{
    function index($id = '')
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
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $lecturer = new Lecturer();
        $results = false;
        $error = '';

        if (($page_tab == 'lecturers_add' || $page_tab == 'lecturers_remove') && count($_POST) > 0) {
            if (isset($_POST['search'])) {
                // find lecturer
                $user = new User();
                if (trim($_POST['name']) == '') {
                    $error = 'Enter user name !!!';
                } else {
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'lecturer' LIMIT 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                    //show($_SESSION['USER']);
                }
            }

            if (isset($_POST['select'])) {
                // add lecturer
                $query = "SELECT id FROM lecturers WHERE user_id = :user_id && class_id = :class_id && disabled = 0 LIMIT 10";
                $user_id = $_POST['select'];

                if ($page_tab == 'lecturers_add') {
                    if (!$lecturer->query($query, [
                        'user_id' => $user_id,
                        'class_id' => $id
                    ])) {
                        $arr = [];
                        $arr['user_id'] = $user_id;
                        $arr['class_id'] = $id;
                        $arr['disabled'] = 0;
                        $arr['date'] = date("y-m-d h:i:s");
                        $lecturer->insert($arr);
                        $this->redirect("single_class/$id?tab=lecturers");
                    } else {
                        $error = 'User already exists !';
                    }
                } else {
                    if ($page_tab == 'lecturers_remove') {
                        $row = $lecturer->query($query, [
                            'user_id' => $user_id,
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
            }

        } elseif ($page_tab == 'lecturers') {
            // display lecturers
            $query = "SELECT * FROM lecturers WHERE disabled = 0 && class_id = :class_id";
            $lecturers = $lecturer->query($query, ['class_id'=>$id]);
            $data['lecturers'] = $lecturers;
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;

        $this->view('single_class', $data);
    }
}
