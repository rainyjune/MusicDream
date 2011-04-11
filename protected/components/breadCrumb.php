<?php
class BreadCrumb extends CWidget {

    public $crumbs = array();
    public $delimiter = ' / ';

    public function run() {
        $this->render('breadCrumb');
    }

}
?>