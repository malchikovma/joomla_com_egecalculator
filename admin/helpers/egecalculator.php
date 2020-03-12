<?php

defined('_JEXEC') or die;

/**
 * Banners component helper.
 *
 * @since  1.6
 */
class EgecalculatorHelper extends JHelperContent
{
    /**
     * Configure the Linkbar.
     *
     * @param   string  $vName  The name of the active view.
     *
     * @return  void
     *
     * @since   1.6
     */
    public static function addSubmenu($vName)
    {
        JHtmlSidebar::addEntry(
            'Предметы',
            'index.php?option=com_egecalculator&view=subjects',
            $vName == 'banners'
        );

        JHtmlSidebar::addEntry(
            'Направления',
            'index.php?option=com_egecalculator&view=directions',
            $vName == 'categories'
        );
    }

}
