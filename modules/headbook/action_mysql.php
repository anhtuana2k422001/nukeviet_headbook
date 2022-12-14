<?php

/**
 * @Project TMS HOLDINGS
 * @Author Ho Anh Tuan <anhtuana2k422001@gmail.com>
 * @Copyright (C) 2022 Ho Anh Tuan. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 27 Nov 2022 09:22:25 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_organizations";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_department";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_schools";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_grade";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_teacher";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_times";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_class";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_subjects";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_lessons";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_distribution";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_year";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_week";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_headbook";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_contents";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_summary";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_setting";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_organizations (
  organizations_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? s??? gi??o d???c',
  organization_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n s??? gi??o d???c',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (organizations_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_department (
  department_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? ph??ng ????o t???o',
  department_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n ph??ng ????o t???o',
  organizations_id smallint(4) NOT NULL COMMENT 'M?? s??? gi??o d???c',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (department_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_schools (
  school_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? tr?????ng',
  school_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n tr?????ng',
  department_id smallint(4) NOT NULL COMMENT 'M?? ph??ng ????o t???o',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (school_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_grade (
  grade_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? kh???i',
  grade_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n kh???i',
  school_id smallint(4) NOT NULL COMMENT 'M?? tr?????ng',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (grade_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_teacher (
  teacher_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? gi??o vi??n',
  userid mediumint(8) NOT NULL COMMENT 'M?? t??i kho???n',
  teacher_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n gi??o vi??n',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Tr???ng th??i',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (teacher_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_times (
  times_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? m??n h???c',
  times_name varchar(200) NOT NULL DEFAULT '' COMMENT 'S??? th??? t??? ti???t',
  minutes smallint(4) NOT NULL DEFAULT 45 COMMENT 'S??? ph??t',
  PRIMARY KEY (times_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_class (
  class_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? l???p',
  class_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n l???p',
  grade_id smallint(4) NOT NULL COMMENT 'M?? kh???i',
  amount smallint(4) NOT NULL DEFAULT 0 COMMENT 'S?? s???',
  teacher_id smallint(4) NOT NULL COMMENT 'M?? gi??o vi??n',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (class_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_subjects (
  subject_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? m??n h???c',
  subject_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n m??n h???c',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Tr???ng th??i',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (subject_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_lessons (
  lesson_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? b??i h???c',
  lesson_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n b??i h???c',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Tr???ng th??i',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (lesson_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_distribution (
  distribution_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? ph??n PPCT',
  times_id tinyint(4) NOT NULL COMMENT 'M?? ti???t',
  lesson_id smallint(4) NOT NULL COMMENT 'M?? b??i h???c',
  subject_id smallint(4) NOT NULL COMMENT 'M?? m??n h???c',
  grade_id smallint(4) NOT NULL COMMENT 'M?? kh???i',
  year_id smallint(4) NOT NULL COMMENT 'M?? n??m',
  PRIMARY KEY (distribution_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_year (
  year_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? n??m',
  year_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n n??m h???c',
  description varchar(200) NOT NULL DEFAULT '' COMMENT 'M?? t???',
  PRIMARY KEY (year_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_week (
  week_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? tu???n ',
  week_name varchar(200) NOT NULL DEFAULT '' COMMENT 'Tu???n',
  start_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian b???t ?????u',
  end_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian k???t th??c',
  description varchar(200) NOT NULL DEFAULT '' COMMENT 'M?? t???',
  year_id smallint(4) NOT NULL DEFAULT 0 COMMENT 'M?? n??m',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Tr???ng th??i',
  PRIMARY KEY (week_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_headbook (
  headbook_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? s??? ?????u b??i',
  headbook_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n s??? ?????u b??i ',
  class_id smallint(4) NOT NULL COMMENT 'M?? l???p',
  year_id int(4) NOT NULL COMMENT 'M?? n??m',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Tr???ng th??i',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (headbook_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_contents (
  content_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'M?? n???i dung',
  headbook_id smallint(4) NOT NULL COMMENT 'M?? s??? ?????u b??i',
  week_id smallint(4) NOT NULL COMMENT 'M?? tu???n',
  order_name smallint(4) NOT NULL COMMENT 'Th???',
  session tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Bu???i',
  times smallint(4) NOT NULL COMMENT 'STT Ti???t',
  subject_id smallint(4) NOT NULL COMMENT 'M?? m??n h???c',
  times_id tinyint(4) NOT NULL COMMENT 'M?? ti???t',
  lesson_id smallint(4) NOT NULL COMMENT 'M?? b??i h???c',
  comment varchar(200) NOT NULL DEFAULT '' COMMENT 'Nh???n x??t',
  point smallint(4) NOT NULL COMMENT '??i???m',
  teacher_id smallint(4) NOT NULL COMMENT 'M?? gi??o vi??n',
  PRIMARY KEY (content_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_summary (
  summary_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? t???ng k???t tu???n',
  week_id smallint(4) NOT NULL COMMENT 'M?? tu???n',
  headbook_id smallint(4) NOT NULL COMMENT 'M?? s??? ?????u b??i',
  headmaster_id smallint(4) NOT NULL COMMENT 'M?? gv ch??? nhi???m',
  comment varchar(200) NOT NULL DEFAULT '' COMMENT 'Nh???n x??t',
  add_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian th??m',
  update_time int(11) NOT NULL DEFAULT 0 COMMENT 'Th???i gian c???p nh???t',
  PRIMARY KEY (summary_id)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_setting (
  setting_id smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'M?? c???u h??nh ',
  setting_name varchar(200) NOT NULL DEFAULT '' COMMENT 'T??n c???u h??nh',
  status tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Tr???ng th??i',
  PRIMARY KEY (setting_id)
) ENGINE=MyISAM;";


// +++++++++++++++++++++++++++ Th??m d??? li???u m???u +++++++++++++++++++++++++++

/* S??? GD&??T  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_organizations` (`organizations_id`, `organization_name`, `add_time`, `update_time`) VALUES
(1, 'S??? GD&??T TP.HCM', 1669482000, 1669482000),
(2, 'S??? GD&??T H?? N???i', 1669482000, 1668963600),
(3, 'S??? GD&??T Ngh??? An', 1669482000, 1668963600)";

/* Ph??ng GD&??T  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_department` (`department_id`, `department_name`, `organizations_id`, `add_time`, `update_time`) VALUES
(1, 'Ph??ng GD&??T Th??nh ph??? Vinh', 3, 1669568400, 1669568400),
(2, 'Ph??ng GD&??T Huy???n Qu???nh L??u', 3, 1669568400, 1669568400),
(3, 'Ph??ng GD&??T Th??? x?? C???a L??', 3, 1669568400, 1669568400)";


/* Tr?????ng  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_schools` (`school_id`, `school_name`, `department_id`, `add_time`, `update_time`) VALUES
(1, 'Tr?????ng THPT Qu???nh L??u 1', 2, 1669568400, 1669568400),
(2, 'Tr?????ng THPT Qu???nh L??u 2', 2, 1669568400, 1669568400),
(3, 'Tr?????ng THPT Qu???nh L??u 3', 2, 1669568400, 1669568400),
(4, 'Tr?????ng THPT Qu???nh L??u 4', 2, 1669568400, 1669568400)";

/* kh???i*/
$sql_create_module[] = "INSERT INTO `nv4_headbook_grade` (`grade_id`, `grade_name`, `school_id`, `add_time`, `update_time`) VALUES
(1, 'Kh???i 10', 4, 1669568400, 1669568400),
(2, 'Kh???i 11', 4, 1669568400, 1669568400),
(3, 'Kh???i 12', 4, 1669568400, 1669568400)";

/* T??i kho???n  */
// $sql_create_module[] = "INSERT INTO `nv4_users` (`userid`, `group_id`, `username`, `md5username`, `password`, `email`, `first_name`, `last_name`, `gender`, `photo`, `birthday`, `sig`, `regdate`, `question`, `answer`, `passlostkey`, `view_mail`, `remember`, `in_groups`, `active`, `active2step`, `secretkey`, `checknum`, `last_login`, `last_ip`, `last_agent`, `last_openid`, `last_update`, `idsite`, `safemode`, `safekey`, `email_verification_time`, `active_obj`) VALUES
// (2, 3, 'hoanhtuan', '7b2cc47330e28464b7d1b80da9a8f1e1', '{SSHA512}CbR4Zsii4HdOpLJBZLtP1J2VLxdVc2VOmgi5GQlZAQ8xMVW5eYNg+EPE2bMyO9Zy2N73Bid+ERhAwy7j2YbYFzI1YjI=', 'anhtuana2k422001@gmail.com', 'Tu???n', 'H??? Anh', 'M', 'uploads/users/avata_hoanhtuan_s2bqgoch_1.jpg', 978886800, 'tu???n', 1669650066, 'C???u th??? y???u th??ch nh???t', 'ronaldo', '', 0, 1, '3,4', 1, 0, '', '4dadbb8a8efa83df4d36b2c13694c883', 1669650319, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '', 1669655077, 0, 0, '', 0, 'SYSTEM'),
// (3, 3, 'nguyenhaiduong', 'b34ebdf72d9213357c061064b61d6fb3', '{SSHA512}AHgMUprZA+z1Rad4Ke/+rQgXTA7GC+A1vGNGlsK1M6Q8aaCdMuiL/afCYrKk0SHaw4DQyaOuCkzLGCp8RkAjh2NiYWM=', 'nguyenhaiduong190801@gmail.com', 'D????ng', 'Nguy???n H???i', 'M', 'uploads/users/pngtree-cartoon-flat-math-teacher-avatar-design-png-image_4429178_s1ulda35_1.jpg', 998154000, 'd????ng', 1669654982, 'C???u th??? y???u th??ch nh???t', 'ronaldo', '', 0, 1, '3,4', 1, 0, '', '', 0, '', '', '', 1669655139, 0, 0, '', -1, 'SYSTEM'),
// (4, 3, 'voanhquan', '16c2c1c20d2c61d8f1a37a2eb2792b87', '{SSHA512}bBER00/is5ee8cK3rWBfsFC1KdTCMjqkKnkNXRPn9rPGJeItPp6Q7HAGGkwPVar1lfJcxY70SP3+s8I7rI2YjDU5NTM=', '01642027120q@gmail.com', 'Qu??n', 'V?? Anh', 'M', 'uploads/users/pngtree-cartoon-flat-math-teacher-avatar-design-png-image_4429178_z181rzaw_1.jpg', 1003770000, 'qu??n', 1669659205, 'C???u th??? y???u th??ch nh???t', 'ronaldo', '', 0, 1, '4,3', 1, 0, '', '', 0, '', '', '', 0, 0, 0, '', -1, 'SYSTEM')";

/* Gi??o vi??n  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_teacher` (`teacher_id`, `userid`, `teacher_name`, `status`, `add_time`, `update_time`) VALUES
(2, 3, 'Nguy???n H???i D????ng', 1, 1669568400, 1669568400),
(3, 4, 'V?? Anh Qu??n', 1, 1669568400, 1669568400),
(4, 2, 'H??? Anh tu???n', 1, 1669568400, 1669568400)";

/* Ti???t d???y  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_times` (`times_id`, `times_name`, `minutes`) VALUES
(1, 'Ti???t 1', 45),
(2, 'Ti???t 2', 45),
(3, 'Ti???t 3', 45),
(4, 'Ti???t 4', 45),
(5, 'Ti???t 5', 45),
(6, 'Ti???t 6', 45),
(7, 'Ti???t 7', 45),
(8, 'Ti???t 8', 45),
(9, 'Ti???t 9', 45),
(10, 'Ti???t 10', 45),
(11, 'Ti???t 11', 45),
(12, 'Ti???t 12', 45),
(13, 'Ti???t 13', 45),
(14, 'Ti???t 14', 45),
(15, 'Ti???t 15', 45),
(16, 'Ti???t 16', 45),
(17, 'Ti???t 17', 45),
(18, 'Ti???t 18', 45),
(19, 'Ti???t 19', 45),
(20, 'Ti???t 20', 45),
(21, 'Ti???t 21', 45),
(22, 'Ti???t 22', 45),
(23, 'Ti???t 23', 45),
(24, 'Ti???t 24', 45),
(25, 'Ti???t 25', 45),
(26, 'Ti???t 26', 45),
(27, 'Ti???t 27', 45),
(28, 'Ti???t 28', 45),
(29, 'Ti???t 29', 45),
(30, 'Ti???t 30', 45)";

/* L???p h???c  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_class` (`class_id`, `class_name`, `grade_id`, `amount`, `teacher_id`, `add_time`, `update_time`) VALUES
(1, 'L???p 12A1', 3, 34, 4, 1670000400, 1670000400),
(3, 'L???p 11A1', 2, 32, 3, 1670000400, 1670000400),
(4, 'L???p 10A1', 1, 35, 2, 1670000400, 1670000400),
(5, 'L???p 12A2', 3, 34, 4, 1670346000, 1670346000),
(6, 'L???p 12A3', 3, 32, 3, 1670346000, 1670346000),
(7, 'L???p 12A4', 3, 34, 2, 1670346000, 1670346000),
(8, 'L???p 12A5', 3, 35, 4, 1670346000, 1670346000),
(9, 'L???p 12A6', 3, 44, 3, 1670346000, 1670346000),
(10, 'L???p 12A7', 3, 36, 2, 1670346000, 1670346000),
(11, 'L???p 12A8', 3, 35, 4, 1670346000, 1670346000),
(13, 'L???p 12A9', 3, 35, 4, 1670346000, 1670346000),
(14, 'L???p 12A10', 3, 36, 3, 1670346000, 1670346000),
(15, 'L???p 11A2', 2, 34, 4, 1670346000, 1670346000),
(16, 'L???p 11A3', 2, 23, 3, 1670346000, 1670346000),
(17, 'L???p 11A4', 2, 24, 2, 1670346000, 1670346000),
(18, 'L???p 11A5', 2, 36, 4, 1670346000, 1670346000),
(19, 'L???p 11A6', 2, 43, 4, 1670346000, 1670346000),
(20, 'L???p 11A7', 2, 34, 3, 1670346000, 1670346000),
(21, 'L???p 11A8', 2, 23, 2, 1670346000, 1670346000),
(22, 'L???p 11A9', 2, 42, 4, 1670346000, 1670346000),
(23, 'L???p 11A10', 2, 34, 2, 1670346000, 1670346000),
(24, 'L???p 10A2', 1, 35, 2, 1670346000, 1670346000),
(25, 'L???p 10A3', 1, 42, 3, 1670346000, 1670346000),
(26, 'L???p 10A4', 1, 42, 4, 1670346000, 1670346000),
(27, 'L???p 10A5', 1, 35, 4, 1670346000, 1670346000),
(28, 'L???p 10A6', 1, 31, 4, 1670346000, 1670346000),
(29, 'L???p 10A7', 1, 42, 3, 1670346000, 1670346000),
(30, 'L???p 10A8', 1, 35, 2, 1670346000, 1670346000),
(31, 'L???p 10A9', 1, 32, 4, 1670346000, 1670346000),
(32, 'L???p 10A10', 1, 31, 4, 1670346000, 1670346000)";

/* M??n h???c  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_subjects` (`subject_id`, `subject_name`, `status`, `add_time`, `update_time`) VALUES
(1, 'Tin h???c l???p 12', 1, 1670000400, 1670000400),
(2, 'C??ng ngh??? l???p 12', 1, 1670000400, 1670000400),
(3, 'Sinh h???c L???p 12', 1, 1670000400, 1670000400),
(4, 'V???t L?? L???p 12', 1, 1670000400, 1670000400),
(5, 'H??a h???c L???p 12', 1, 1670000400, 1670000400),
(6, 'L???ch S??? l???p 12', 1, 1670000400, 1670000400),
(7, '?????a L?? l???p 12', 1, 1670000400, 1670000400),
(8, 'GDCD l???p 12', 1, 1670000400, 1670000400),
(9, 'To??n h???c l???p 12', 1, 1670000400, 1670000400),
(10, 'Ngo???i ng??? l???p 12', 1, 1670000400, 1670000400),
(11, 'Ng??? v??n l???p 12', 1, 1670000400, 1670000400)";

/* B??i h???c  */
$sql_create_module[] = "INSERT INTO `nv4_headbook_lessons` (`lesson_id`, `lesson_name`, `status`, `add_time`, `update_time`) VALUES
(1, '?????c v??n. KH??I QU??T V??N H???C VI???T NAM  T??? C??CH M???NG TH??NG T??M N??M 1945 ?????N H???T TH??? K??? XX', 1, 1670000400, 1670000400),
(2, 'L??m v??n. NGH??? LU???N V??? M???T T?? T?????NG, ?????O L??', 1, 1670000400, 1670000400),
(3, '?????c v??n. TUY??N NG??N ?????C L???P - H??? CH?? MINH', 1, 1670000400, 1670000400),
(4, 'Ti???ng Vi???t. GI??? G??N S??? TRONG S??NG C???A TI???NG VI???T', 1, 1670000400, 1670000400),
(5, 'L??m v??n. B??I L??M V??N S??? 1 (NGH??? LU???N X?? H???I)', 1, 1670000400, 1670000400),
(6, '?????c v??n. TUY??N NG??N ?????C L???P (H??? Ch?? Minh) (Ph???n 2. T??C PH???M)', 1, 1670000400, 1670000400),
(7, 'Ti???ng Vi???t.  GI??? G??N S??? TRONG S??NG C???A TI???NG VI???T (ti???p)', 1, 1670000400, 1670000400),
(8, '?????c v??n.  NGUY???N ????NH CHI???U, NG??I SAO S??NG TRONG V??N NGH??? C???A D??N T???C', 1, 1670000400, 1670000400),
(9, 'B??i 1. S??? ?????ng bi???n, nghich bi???n c???a h??m s???', 1, 1670000400, 1670000400),
(10, 'B??i 2. C???c tr??? c???a h??m s???', 1, 1670000400, 1670000400),
(11, 'B??i 3. Gi?? tr??? l???n nh???t v?? gi?? tr??? nh??? nh???t c???a h??m s???', 1, 1670000400, 1670000400),
(12, 'B??i 4. ???????ng ti???m c???n', 1, 1670000400, 1670000400),
(13, 'B??i 5. Kh???o s??t s??? bi???n thi??n v?? v??? ????? th??? c???a h??m s???', 1, 1670000400, 1670000400),
(14, 'B??i 1. Kim lo???i ki???m', 1, 1670346000, 1670346000),
(15, 'B??i 2. Kim lo???i ki???m th??? v?? m???t s??? h???p ch???t quan tr???ng c???a kim lo???i ki???m th???', 1, 1670346000, 1670346000),
(16, 'B??i 3. Luy???n t???p: T??nh ch???t c???a kim lo???i ki???m, kim lo???i ki???m th??? v?? h???p ch???t c???a ch??ng', 1, 1670346000, 1670346000),
(17, 'B??i 4. Nh??m v?? m???t s??? h???p ch???t quan tr???ng c???a nh??m', 1, 1670346000, 1670346000),
(18, 'B??i 5. Luy???n t???p: T??nh ch???t c???a nh??m v?? h???p ch???t c???a nh??m', 1, 1670346000, 1670346000),
(19, 'B??i 1. ??n t???p/ Ki???m tra ?????u n??m', 1, 1670346000, 1670346000),
(20, 'B??i 2. Unit 1: Reading', 1, 1670346000, 1670346000),
(21, 'B??i 3. Speaking: g???p Task 2, Task 3 th??nh 1 Ho???t ?????ng', 1, 1670346000, 1670346000),
(22, 'B??i 4.T??? ch???n 1- Reading- Home Life', 1, 1670346000, 1670346000),
(23, 'B??i 5. Listening', 1, 1670346000, 1670346000),
(24, 'B??i 1. Dao ?????ng ??i???u h??a', 1, 1670346000, 1670346000),
(25, 'B??i 2. B??i t???p', 1, 1670346000, 1670346000),
(26, 'B??i 3. Con l???c l?? xo', 1, 1670346000, 1670346000),
(27, 'B??i 4. B??i t???p', 1, 1670346000, 1670346000),
(28, 'B??i 5. Con l???c ????n', 1, 1670346000, 1670346000)";

/* N??m h???c*/
$sql_create_module[] = "INSERT INTO `nv4_headbook_year` (`year_id`, `year_name`, `description`) VALUES
(1, '2022 - 2023', 'N??m h???c 2022- 2023'),
(2, '2021 - 2022', 'N??m h???c 2021- 2022')";

/* Tu???n*/
$sql_create_module[] = "INSERT INTO `nv4_headbook_week` (`week_id`, `week_name`, `start_time`, `end_time`, `description`, `year_id`, `status`) VALUES
(1, 'Tu???n 1', 1669568400, 1670000400, 'Tu???n 1', 1, 1),
(2, 'Tu???n 2', 1670173200, 1670605200, 'Tu???n 2', 1, 1),
(3, 'Tu???n 3', 1670778000, 1671210000, 'Tu???n 3', 1, 1),
(4, 'Tu???n 4', 1671382800, 1671814800, 'Tu???n 4', 1, 1),
(5, 'Tu???n 5', 1671987600, 1672419600, 'Tu???n 5', 1, 1)";

/* Ph??n ph???i ch????ng tr??nh */
$sql_create_module[] = "INSERT INTO `nv4_headbook_distribution` (`distribution_id`, `times_id`, `lesson_id`, `subject_id`, `grade_id`, `year_id`) VALUES
(1, 1, 1, 11, 3, 1),
(2, 2, 1, 11, 3, 1),
(3, 3, 2, 11, 3, 1),
(4, 4, 3, 11, 3, 1),
(5, 5, 4, 11, 3, 1),
(6, 6, 5, 11, 3, 1),
(7, 7, 6, 11, 3, 1),
(8, 8, 6, 11, 3, 1),
(9, 9, 7, 11, 3, 1),
(10, 10, 8, 10, 3, 1),
(11, 1, 9, 9, 3, 1),
(12, 2, 10, 9, 3, 1),
(13, 3, 11, 9, 3, 1),
(14, 4, 12, 9, 3, 1),
(15, 1, 14, 5, 3, 1),
(16, 2, 15, 5, 3, 1),
(17, 3, 16, 5, 3, 1),
(18, 4, 17, 5, 3, 1),
(19, 5, 18, 5, 3, 1),
(20, 1, 19, 10, 3, 1),
(21, 2, 20, 10, 3, 1),
(22, 3, 21, 10, 3, 1),
(23, 4, 22, 10, 3, 1),
(24, 5, 23, 10, 3, 1),
(25, 1, 24, 4, 3, 1),
(26, 2, 25, 4, 3, 1),
(27, 3, 26, 4, 3, 1),
(28, 4, 27, 4, 3, 1),
(29, 5, 28, 4, 3, 1)";


/* S??? ?????u b??i */
$sql_create_module[] = "INSERT INTO `nv4_headbook_headbook` (`headbook_id`, `headbook_name`, `class_id`, `year_id`, `status`, `add_time`, `update_time`) VALUES
(1, 'S??B l???p 12A1', 1, 1, 1, 1670086800, 1670086800),
(2, 'S??B l???p 11A1', 3, 1, 1, 1670086800, 1670086800),
(3, 'S??B l???p 10A1', 4, 1, 1, 1670086800, 1670086800),
(4, 'S??B l???p 12A2', 5, 1, 1, 1670346000, 1670346000),
(5, 'S??B l???p 12A3', 6, 1, 1, 1670346000, 1670346000),
(6, 'S??B l???p 12A4', 7, 1, 1, 1670346000, 1670346000),
(7, 'S??B l???p 12A5', 8, 1, 1, 1670346000, 1670346000),
(8, 'S??B l???p 12A6', 9, 1, 1, 1670346000, 1670346000),
(9, 'S??B l???p 12A7', 10, 1, 1, 1670346000, 1670346000),
(10, 'S??B l???p 12A8', 11, 1, 1, 1670346000, 1670346000),
(11, 'S??B l???p 12A9', 13, 1, 1, 1670346000, 1670346000),
(12, 'S??B l???p 12A10', 14, 1, 1, 1670346000, 1670346000),
(13, 'S??B l???p 11A2', 15, 1, 1, 1670346000, 1670346000),
(14, 'S??B l???p 11A3', 16, 1, 1, 1670346000, 1670346000),
(15, 'S??B l???p 11A4', 17, 1, 1, 1670346000, 1670346000),
(16, 'S??B l???p 11A5', 18, 1, 1, 1670346000, 1670346000),
(17, 'S??B l???p 11A6', 19, 1, 1, 1670346000, 1670346000),
(18, 'S??B l???p 11A7', 20, 1, 1, 1670346000, 1670346000),
(19, 'S??B l???p 11A8', 21, 1, 1, 1670346000, 1670346000),
(20, 'S??B l???p 11A9', 22, 1, 1, 1670346000, 1670346000),
(21, 'S??B l???p 11A10', 23, 1, 1, 1670346000, 1670346000),
(22, 'S??B l???p 10A2', 24, 1, 1, 1670346000, 1670346000),
(23, 'S??B l???p 10A3', 25, 1, 1, 1670346000, 1670346000),
(24, 'S??B l???p 10A4', 26, 1, 1, 1670346000, 1670346000),
(25, 'S??B l???p 10A5', 27, 1, 1, 1670346000, 1670346000),
(26, 'S??B l???p 10A6', 28, 1, 1, 1670346000, 1670346000),
(27, 'S??B l???p 10A7', 29, 1, 1, 1670346000, 1670346000),
(28, 'S??B l???p 10A8', 30, 1, 1, 1670346000, 1670346000),
(29, 'S??B l???p 10A9', 31, 1, 1, 1670346000, 1670346000),
(30, 'S??B l???p 10A10', 32, 1, 1, 1670346000, 1670346000)";

/* N???i dung s??? ?????u b??i */
$sql_create_module[] = "INSERT INTO `nv4_headbook_contents` (`content_id`, `headbook_id`, `week_id`, `order_name`, `session`, `times`, `subject_id`, `times_id`, `lesson_id`, `comment`, `point`, `teacher_id`) VALUES
(1, 1, 1, 1, 1, 1, 11, 1, 1, 'L???p h???c t???t', 10, 4),
(2, 1, 1, 1, 1, 2, 9, 1, 9, 'L???p h???c nghi??m t??c', 10, 3),
(3, 1, 1, 1, 1, 3, 5, 1, 14, 'M???t s??? h???c sinh ch??a l??m b??i t???p', 9, 2),
(4, 1, 1, 1, 1, 4, 10, 1, 20, 'L???p ho???t ?????ng s??i n???i', 10, 4),
(5, 1, 1, 1, 1, 5, 4, 1, 24, 'L???p ch?? ?? x??y d???ng b??i', 10, 3)";

/* T???ng k???t tu???n */
$sql_create_module[] = "INSERT INTO `nv4_headbook_summary` (`summary_id`, `week_id`, `headbook_id`, `headmaster_id`, `comment`, `add_time`, `update_time`) VALUES
(1, 1, 1, 4, 'L???p ?????t ??i???m tuy???t ?????i', 1670086800, 1670086800)";
