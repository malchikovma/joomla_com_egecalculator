<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorModelSubject extends JModelAdmin
{
    public function getTable($name = 'Subject', $prefix = 'EgecalculatorTable', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_egecalculator.subject',
            'subject',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState(
            'com_egecalculator.edit.subject.data',
            []
        );

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }
}