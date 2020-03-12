<?php

defined('_JEXEC') or die();

class EgecalculatorViewSubject extends JViewLegacy
{
    protected $form = null;

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

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

        $isNew = ($this->item->id === 0);

        if ($isNew)
        {
            $title = JText::_('COM_EGECALCULATOR_MANAGER_SUBJECT_NEW');
        }
        else
        {
            $title = JText::_('COM_EGECALCULATOR_MANAGER_SUBJECT_EDIT');
        }

        JToolbarHelper::title($title);
        JToolbarHelper::save('subject.save');
        JToolbarHelper::cancel(
            'subject.cancel',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );
    }
}