<?php

class EgecalculatorTableSubject extends JTable
{
    function __construct($db)
    {
        parent::__construct('#__egecalculator_subjects', 'id', $db);
    }
}