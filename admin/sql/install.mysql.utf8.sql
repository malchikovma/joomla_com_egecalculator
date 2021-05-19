-- 0.0.1

DROP TABLE IF EXISTS `#__egecalculator_directions`;
CREATE TABLE `#__egecalculator_directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `published` tinyint(4) DEFAULT '1',
  `fulltime_places` int(11) DEFAULT NULL,
  `fulltime_score` int(11) DEFAULT NULL,
  `distant_places` int(11) DEFAULT NULL,
  `distant_score` int(11) DEFAULT NULL,
  `subjects_ids` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `#__egecalculator_subjects`;
CREATE TABLE `#__egecalculator_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `#__egecalculator_subjects` (`title`) VALUES
('Русский язык'),
('Математика (профиль)'),
('Физика'),
('Обществознание'),
('Информатика и ИКТ'),
('История'),
('Литература'),
('Иностранный язык'),
('Комплексный экзамен по ОФП (общей физической подготовке)'),
('Творческое вступительное испытание');

-- 0.0.2

ALTER TABLE `#__egecalculator_directions`
    CHANGE `subjects_ids` `required_subjects_ids` VARCHAR(100) NULL,
    ADD `optional_subjects_ids` VARCHAR(100) NULL;

-- 0.1.0

ALTER TABLE `#__egecalculator_directions`
    ADD `catid` INT(11) NOT NULL DEFAULT '0' AFTER `id`,
    DROP COLUMN `fulltime_places`,
    DROP COLUMN `fulltime_score`,
    DROP COLUMN `distant_places`,
    DROP COLUMN `distant_score`,
    ADD `budget_places` INT(11) DEFAULT NULL,
    ADD `paid_places` INT(11) DEFAULT NULL,
    ADD `passing_grade` INT(11) DEFAULT NULL;

-- 1.1.0

ALTER TABLE `#__egecalculator_subjects`
    ADD `type` INT DEFAULT 0 NOT NULL;

-- 1.2.0

ALTER TABLE `#__egecalculator_directions`
    ADD `link` VARCHAR(2048) DEFAULT '' NOT NULL;

