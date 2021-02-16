ALTER TABLE `#__egecalculator_directions` CHANGE
    `subjects_ids` `required_subjects_ids` VARCHAR(100) NULL;
ALTER TABLE `#__egecalculator_directions`
    ADD `optional_subjects_ids` VARCHAR(100) NULL;
