mysql -u'strikerapp' -p'Off!c3@v2017' sms -e 'delete from duplicatecheck where datetime <= DATE_SUB(now(), INTERVAL 10 MINUTE);'
