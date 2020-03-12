<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorViewDirections extends JViewLegacy {
    function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $subjects = $input->get('subjects', array(), 'ARRAY');
        $model = $this->getModel();
        if ($subjects)
        {
            $records = $model->getDirections($subjects);
            if ($records)
            {
                echo new JResponseJson($records);
            }
            else
            {
                echo new JResponseJson(null, JText::_('COM_EGECALCULATOR_ERROR_NO_DIRECTIONS'), true);
            }
        }
        else
        {
            $records = array();
            echo new JResponseJson(null, JText::_('COM_EGECALCULATOR_ERROR_NO_SUBJECTS'), true);
        }
    }
}