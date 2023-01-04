<?php

class Pager
{
    public $links = [];
    public $offset = 0;
    public $page_number = 1;
    public $start = 1;
    public $end = 1;


    public function __construct($limit = 2, $extras = 1){
        $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;

        $this->start = $page_number - $extras;
        $this->end = $page_number + $extras;

        if($this->start < 1){
            $this->start = 1;
        }
        $this->offset = ($page_number - 1) * $limit;
        $this->page_number = $page_number;

        $current_link = ROOT . '/' . str_replace("url=", "", $_SERVER['QUERY_STRING']);
        $current_link = !strstr($current_link, 'page=') ? $current_link . '&page=1' : $current_link;
        $first_link = preg_replace('/page=[0-9]+/', 'page=1', $current_link);
        $next_link = preg_replace('/page=[0-9]+/', 'page=' . ($page_number + 1), $current_link);

        $this->links['first'] = $first_link;
        $this->links['next'] = $next_link;
        $this->links['current'] = $current_link;
    }

    public function display(){ ?>
        <nav class="mt-2">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="<?=$this->links['first']?>">First</a>
                </li>

                <?php
                for($x = $this->start; $x <= $this->end; $x++): ?>
                    <li class="page-item"><a class="page-link <?=$this->page_number == $x ? 'active' : ''?>" href="
                    <?=preg_replace('/page=[0-9]+/', 'page=' . $x, $this->links['next'])?>
                    "><?=$x?></a></li>
                <?php endfor; ?>

                <li class="page-item">
                    <a class="page-link" href="<?=$this->links['next']?>">Next</a>
                </li>
            </ul>
        </nav>
    <?php
    }
}
?>