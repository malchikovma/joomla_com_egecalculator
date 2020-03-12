<?php

class EgecalculatorTableDirection extends JTable
{
    function __construct($db)
    {
        parent::__construct('#__egecalculator_directions', 'id', $db);
    }

    public function bind($src, $ignore = array())
    {
        if (is_array($src['subjects_ids'])){
            $src['subjects_ids'] = implode(',',$src['subjects_ids']);
        } else if(is_null($src['subjects_ids'])) {
            $src['subjects_ids'] = '';
        }
        return parent::bind($src, $ignore);
    }

}