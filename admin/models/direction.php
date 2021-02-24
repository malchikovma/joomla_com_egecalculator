<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorModelDirection extends JModelAdmin
{
    public function getTable($name = 'Direction', $prefix = 'EgecalculatorTable', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_egecalculator.direction',
            'direction',
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
            'com_egecalculator.edit.direction.data',
            []
        );

        if (empty($data))
        {
            $data = $this->getItem();
            $data->required_subjects_ids = explode(',', $data->required_subjects_ids);
            $data->optional_subjects_ids = explode(',', $data->optional_subjects_ids);
        }

        return $data;
    }

    public function save($data)
    {
        $data['required_subjects_ids'] = implode(',', $data['required_subjects_ids']);
		$data['optional_subjects_ids'] = implode(',', $data['optional_subjects_ids']) ?: '';
        return parent::save($data);
    }

}
