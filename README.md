nmap_web_GUI
==================

## Dockerfile
'''

FROM nickistre/centos-lamp

RUN /etc/init.d/mysqld start \
   && mysql -u root -e "create database toybox;" \
   && mysql -u root -e "use toybox; create table toy (scan_id integer auto_increment primary key,ip_address text(255),port text(255),product text(255),version text(255),name text(255),cpe text(255),extrainfo text(255));"

COPY ./ /var/www/html

RUN chmod 664 /var/www/html/*.php

CMD ["supervisord", "-n"]

'''

## REFER TO

#### Docker hub
[nickistre/docker-lamp](https://github.com/nickistre/docker-lamp)
