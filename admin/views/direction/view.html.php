<?php

defined('_JEXEC') or die();

class EgecalculatorViewDirection extends JViewLegacy
{
    protected $form = null;

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');


        $subjects = $this->item->subjects_ids;
        $this->form->setFieldAttribute('subjects_ids', 'default', $subjects);

        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }

        $this->addToolbar();

        return parent::display($tpl);
    }

    protected function addToolBar()
    {
        $input = JFactory::getApplication()->input;

        $input->set('hidemainmenu', true);

        $isNew = !(bool) $this->item->id;

        if ($isNew)
        {
            $title = JText::_('COM_EGECALCULATOR_MANAGER_DIRECTION_NEW');
        }
        else
        {
            $title = JText::_('COM_EGECALCULATOR_MANAGER_DIRECTION_EDIT');
        }

        JToolbarHelper::title($title);
        JToolbarHelper::save('direction.save');
        JToolbarHelper::cancel(
            'direction.cancel',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );
    }
}