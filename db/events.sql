SET GLOBAL event_scheduler = ON;


DROP EVENT IF EXISTS `autoresetpel`;
DROP EVENT IF EXISTS `autodelete_ked` ;
DROP EVENT IF EXISTS `autodelete_pel` ;

CREATE EVENT `autoresetpel` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
UPDATE tamu SET count_pelanggaran = 0 , terakhir_count =STR_TO_DATE(CURDATE(), '%Y-%m-%d'), blok = 0
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 6 MONTH > STR_TO_DATE(`terakhir_count`, '%Y-%m-%d');

CREATE EVENT `autodelete_ked` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
DELETE FROM kedatangan
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 24 MONTH > STR_TO_DATE(`tanggal_datang`, '%Y-%m-%d');


CREATE EVENT `autodelete_pel` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
DELETE FROM pelaporan
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 24 MONTH > STR_TO_DATE(`tanggal_pelanggaran`, '%Y-%m-%d');

