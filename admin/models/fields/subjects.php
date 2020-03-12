<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list');

/**
 * Voteradio Field class.
 *
 * @since  3.8.0
 */
class JFormFieldSubjects extends JFormFieldList
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  3.7.1
     */
    protected $type = 'subjects';

    /**
     * Method to get the field options.
     *
     * @return array The field option objects.
     *
     * @throws \Exception
     *
     * @since  3.7.1
     */
    public function getOptions()
    {
        $db = JFactory::getDbo();
        $options = [];

        $query = $db->getQuery(true);
        $query->select($db->quoteName(['id', 'title']))
            ->from($db->quoteName('#__egecalculator_subjects'));
        $db->setQuery($query);

        foreach ($db->loadObjectList() as $item) {
            $options[] = JHtml::_('select.option', $item->id, $item->title);
        }
        $this->size = count($options);
        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}
