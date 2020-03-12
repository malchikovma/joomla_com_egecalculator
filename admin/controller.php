<?php
defined('_JEXEC') or die;

JLoader::register('EgecalculatorHelper', JPATH_ADMINISTRATOR . '/components/com_egecalculator/helpers/egecalculator.php');

/**
 * Banners master display controller.
 *
 * @since  1.6
 */
class EgecalculatorController extends JControllerLegacy
{
    protected $default_view = 'directions';
}
