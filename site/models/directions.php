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
        $query->select('title, fulltime_places, fulltime_score, distant_places, distant_score, required_subjects_ids, optional_subjects_ids')
            ->from('#__egecalculator_directions');
        $db->setQuery($query);
        $directions = $db->loadObjectList();
        $subjects = explode(',', $subjects[0]);
        // для каждого направления
        $filteredDirections =  array_filter($directions, function($direction) use ($subjects) {
            $requiredDirectionSubjects = explode(',', $direction->required_subjects_ids);
            $optionalDirectionSubjects = explode(',', $direction->optional_subjects_ids);
            // берем совпадающие предметы в запросе и направлении
            $intersectedRequiredSubjects = array_intersect($requiredDirectionSubjects, $subjects);
            $intersectedOptionalSubjects = array_intersect($optionalDirectionSubjects, $subjects);
            // если количество совпадающих элементов равно тому, что в направлении
			$requiredSubjectsFilled = count($intersectedRequiredSubjects) === count($requiredDirectionSubjects);
			$optionalSubjectsFilled = count($intersectedOptionalSubjects) > 0;
            return $requiredSubjectsFilled && $optionalSubjectsFilled;
        });

        return array_values(
            array_map(function ($direction) {
                unset($direction->required_subjects_ids, $direction->optional_subjects_ids);
                return $direction;
            }, $filteredDirections)
        );
    }
}
