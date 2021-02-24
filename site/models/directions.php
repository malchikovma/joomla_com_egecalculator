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

	/**
	 * @param $subjects array
	 *
	 * @return array
	 */
    public function getDirections($subjects)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title, catid, budget_places, paid_places, passing_grade , required_subjects_ids, optional_subjects_ids')
            ->from('#__egecalculator_directions')
			->order('title');
        $db->setQuery($query);
        $directions = $db->loadObjectList();
        // для каждого направления
        $filteredDirections =  array_filter($directions, function($direction) use ($subjects) {
            $requiredDirectionSubjects = explode(',', $direction->required_subjects_ids);
            $optionalDirectionSubjects = explode(',', $direction->optional_subjects_ids);
            // берем совпадающие предметы в запросе и направлении
            $intersectedRequiredSubjects = array_intersect($requiredDirectionSubjects, $subjects);
            $intersectedOptionalSubjects = array_intersect($optionalDirectionSubjects, $subjects);
            // если количество совпадающих элементов равно тому, что в направлении
			$requiredSubjectsFilled = count($intersectedRequiredSubjects) === count($requiredDirectionSubjects);
			$optionalSubjectsFilled = false;
			// если выбран хотя бы один опциональный предмет
			if (count($intersectedOptionalSubjects) > 0) {
				$optionalSubjectsFilled = true;
			} else {
				// если опциональные предметы не заданы, возвращаем true и считаем только по обязательным
				if (count(array_filter($optionalDirectionSubjects)) === 0) {
					$optionalSubjectsFilled = true;
				} else {
					// если указано 3 и более обязательных предмета
					if (count($intersectedRequiredSubjects) >= 3) {
						$optionalSubjectsFilled = true;
					}
				}
			}
            return $requiredSubjectsFilled && $optionalSubjectsFilled;
        });
		$data = [];
        $data['directions'] = array_values(
            array_map(function ($direction) {
                unset($direction->required_subjects_ids, $direction->optional_subjects_ids);
                return $direction;
            }, $filteredDirections)
        );
		$query = $db->getQuery(true);
		$query->select('id, title')
			->from('#__categories');
		$db->setQuery($query);
		$categories = $db->loadAssocList();
        $data['categories'] = $categories;

        return $data;
    }
}
