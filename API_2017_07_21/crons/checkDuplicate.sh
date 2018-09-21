mysql -u'smsstrikerapp' -p'$tr!k3r@2009' sms -e 'delete from duplicatecheck where datetime <= DATE_SUB(now(), INTERVAL 10 MINUTE);'
