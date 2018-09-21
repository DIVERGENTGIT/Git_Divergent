mysql -u'smsstrikerapp' -p'$tr!k3r@2009' sms -e 'delete from duplicatecheck_api where datetime <= DATE_SUB(now(), INTERVAL 15 MINUTE);'
