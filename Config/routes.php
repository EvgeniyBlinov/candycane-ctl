<?php
Router::connect(
	'/projects/:project_id/ctl/:action',
	array(
		'plugin'     => 'CcCtl',
		'controller' => 'Ctl'
	)
);
