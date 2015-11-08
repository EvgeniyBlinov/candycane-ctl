<?php
/**
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CtlController extends CcCtlAppController {

/**
 * No models required
 *
 * @var array
 * @access public
 */
	public $uses = array('CtlModel');

	public function index() {
		$model = new CtlModel();
		$this->CtlModel = $model;
		$reports = $this->CtlModel->findIIssuesByAssignedTo($this->_project['Project']['id']);
		$this->set('reports', $reports);
	}

}
