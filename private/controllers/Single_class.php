<?php

class Single_class extends Controller
{
    function index($id = ''){
        $classes = new Classe();
        $row = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if($row) {
            $crumbs[] = [$row->class_name, ROOT . ''];
        }
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';

        $this->view('single_class', [
            'row'=>$row,
            'crumbs' => $crumbs,
            'page_tab' => $page_tab
        ]);
    }
}
