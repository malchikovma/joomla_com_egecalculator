<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorModelSubjects extends JModelList
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = [
                'id',
                'title'
            ];
        }
        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__egecalculator_subjects'));

        $search = $this->getState('filter.search');

        if (!empty($search))
        {
            $query->where("title LIKE %{$db->quote($search)}%");
        }


        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering', 'title');
        $orderDirn 	= $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }
}