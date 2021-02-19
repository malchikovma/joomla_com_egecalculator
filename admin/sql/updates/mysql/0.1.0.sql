ALTER TABLE `#__egecalculator_directions`
    ADD `catid` INT(11) NOT NULL DEFAULT '0' AFTER `id`,
    DROP COLUMN `fulltime_places`,
    DROP COLUMN `fulltime_score`,
    DROP COLUMN `distant_places`,
    DROP COLUMN `distant_score`,
    ADD `budget_places` INT(11) DEFAULT NULL,
    ADD `paid_places` INT(11) DEFAULT NULL,
    ADD `passing_grade` INT(11) DEFAULT NULL;
