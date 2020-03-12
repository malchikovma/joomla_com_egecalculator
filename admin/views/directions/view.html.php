<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View class for a list of banners.
 *
 * @since  1.6
 */
class EgecalculatorViewDirections extends JViewLegacy
{

    /**
     * Method to display the view.
     *
     * @param   string  $tpl  A template file to load. [optional]
     *
     * @return  mixed  A string if successful, otherwise a JError object.
     *
     * @since   1.6
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new Exception(implode("\n", $errors), 500);
        }

        $this->addToolBar();

        return parent::display($tpl);
    }

    protected function addToolBar()
    {
        $title = JText::_('COM_EGECALCULATOR_MANAGER_DIRECTIONS');

        JToolbarHelper::title($title);
        JToolbarHelper::addNew('direction.add');
        JToolbarHelper::editList('direction.edit');
        JToolbarHelper::deleteList('direction.delete');
    }
}
