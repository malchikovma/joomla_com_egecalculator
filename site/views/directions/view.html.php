<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorViewDirections extends JViewLegacy
{
    public function display($tpl = null)
    {
        $this->subjects = $this->get('subjects');
        JHtml::_('jquery.framework');
        return parent::display($tpl);
    }
}