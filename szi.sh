#!/bin/sh
while read n;do
cp -r $n /home/srennivass/SMSstriker/
done < /var/www/html/strikerapp/list.txt
