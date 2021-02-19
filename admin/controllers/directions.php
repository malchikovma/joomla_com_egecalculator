<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class EgecalculatorControllerDirections extends JControllerAdmin
{
    public function getModel($name = 'Direction', $prefix = 'EgecalculatorModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}
