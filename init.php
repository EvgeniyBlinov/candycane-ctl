<?php
/**
 * Addning new link in top left menu.
 */
$menuContainer = ClassRegistry::getObject('MenuContainer');

/**
 * Adding new link in porject tabs.
 */
$menuContainer->addProjectMenu( 'ctl', array(
    'plugin'     => 'CcCtl',
    'controller' => 'Ctl',
    'action'     => 'index',
    'class'      => '',
    'caption'    => 'Timelog',
    'params'     => 'project_id',
    '_allowed'   => true // for bypassing permmission system.
));

// make sure put new route setting which includes project_id
CakePlugin::load(
	basename(dirname(__FILE__)),
	array('routes' => true)
);

App::uses('CtlModel', 'CcCtl.Model');
/**
 * register plugin information into container
 */
$pluginContainer = ClassRegistry::getObject('PluginContainer');
$pluginContainer->installed('cc_ctl','0.1');
