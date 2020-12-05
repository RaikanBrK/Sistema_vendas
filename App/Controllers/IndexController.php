<?php 
namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {
	public function index() {
		$this->view->css = ['index'];
		$this->view->js = ['index'];

		$this->render('index');
	}
	
}
?>