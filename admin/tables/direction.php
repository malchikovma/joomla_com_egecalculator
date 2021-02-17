<?php

class EgecalculatorTableDirection extends JTable
{
    function __construct($db)
    {
        parent::__construct('#__egecalculator_directions', 'id', $db);
    }

    public function bind($src, $ignore = array())
    {
    	if (isset($src['requried_subjects_ids'])) {
			if (is_array($src['requried_subjects_ids'])) {
				$src['requried_subjects_ids'] = implode(',', $src['requried_subjects_ids']);
			} else if (is_null($src['requried_subjects_ids'])) {
				$src['requried_subjects_ids'] = '';
			}
		}

    	if (isset($src['optional_subjects_ids'])) {
			if (is_array($src['optional_subjects_ids'])) {
				$src['optional_subjects_ids'] = implode(',', $src['optional_subjects_ids']);
			} else if (is_null($src['optional_subjects_ids'])) {
				$src['optional_subjects_ids'] = '';
			}
		}
        return parent::bind($src, $ignore);
    }

}
