-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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
("Русский язык"),
("Математика (профиль)"),
("Физика"),
("Обществознание"),
("Информатика и ИКТ"),
("История"),
("Литература"),
("Иностранный язык"),
("Комплексный экзамен по ОФП (общей физической подготовке)"),
("Творческое вступительное испытание");

-- 2020-03-12 08:08:12