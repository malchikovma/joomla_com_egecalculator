<?php

defined('_JEXEC') or die;

// No access check.

$controller = JControllerLegacy::getInstance('Egecalculator');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();