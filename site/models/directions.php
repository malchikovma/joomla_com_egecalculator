<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class EgecalculatorModelDirections extends JModelItem
{
    protected $item;
    protected $subjects;

    public function getSubjects()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__egecalculator_subjects');
        $db->setQuery($query);
        $this->subjects = $db->loadObjectList();

        return $this->subjects;
    }

    public function getDirections($subjects)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title, fulltime_places, fulltime_score, distant_places, distant_score, subjects_ids')
            ->from('#__egecalculator_directions');
        $db->setQuery($query);
        $directions = $db->loadObjectList();
        // для каждого направления
        $filteredDirections =  array_filter($directions, function($direction) use ($subjects) {
            $directionSubjects = explode(',', $direction->subjects_ids);
            // берем совпадающие предметы в запросе и направлении
            $intersectedSubjects = array_intersect($directionSubjects, $subjects);
            // если количество совпадающих элементов равно тому, что в направлении
            if (count($intersectedSubjects) === count($directionSubjects)) {
                return true;
            }
            return false;
        });

        return array_values(
            array_map(function ($direction) {
                unset($direction->subjects_ids);
                return $direction;
            }, $filteredDirections)
        );
    }
}