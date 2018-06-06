/*
Import to database to have an administrator after DB setup
user: admin
password: admin
*/

INSERT INTO `joblevel` (`ID`, `level`, `description`) VALUES
(1, 1, 'super admin');

INSERT INTO `employee` (`ID`, `user_id`, `fullname`, `surname`, `position_id`, `employed_date`, `birthday`, `tell`, `email`, `ACTIVE`) VALUES
(1, 1, 'Admin', 'Admin', 1, '2018-01-01', '2018-01-01', '0123456789', 'admin@admin.admin', 1);

INSERT INTO `user` (`ID`, `user`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');
