mysql -p'myadmin' sms -e 'delete from duplicatecheck_api where datetime <= DATE_SUB(now(), INTERVAL 15 MINUTE);'
