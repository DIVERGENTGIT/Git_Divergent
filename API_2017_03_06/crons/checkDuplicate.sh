mysql -p'myadmin' sms -e 'delete from duplicatecheck where datetime <= DATE_SUB(now(), INTERVAL 1 HOUR);'
