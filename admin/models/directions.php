<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorModelDirections extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = [
				'id',
				'title',
				'catid',
			];
		}
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select('d.*')
			->from($db->quoteName('#__egecalculator_directions', 'd'));

		$query->select($db->quoteName('c.title', 'category_title'))
			->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = d.catid');

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$query->where("d.title LIKE {$db->quote('%' . $search . '%')}");
		}
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('d.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(d.published IN (0, 1))');
		}

		$category = $this->getState('filter.category');
		if (is_numeric($category) && (int) $category !== 0)
		{
			$query->where('d.catid = ' . (int) $category);
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'title');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}
