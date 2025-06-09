<?php
namespace src\controllers;

use \core\Controller;
use \core\murano\DB;

class HomeController extends Controller {


    public function index() {

        $this->render('home', []);

    }

}