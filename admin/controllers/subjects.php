<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class EgecalculatorControllerSubjects extends JControllerAdmin
{
    public function getModel($name = 'Subject', $prefix = 'EgecalculatorModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}
