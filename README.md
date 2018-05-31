nmap_web_GUI
==================
## Docker-compose.yml
```
lamp_server:
  image: docker pull box02200059/nmap_web_gui
  #https://github.com/box02200059/nmap_web_GUI
  net: host
  tty: yes
  restart: always
py_nmap_server:
  image: astroicers/docker-nmap_excel_control-n-smb
  #https://github.com/astroicers/docker-nmap_excel_control-n-smb
  volumes:
    - /path/to/share/:/shared
  net: host
  tty: yes
  restart: always
```

## Dockerfile
```
FROM nickistre/centos-lamp

RUN /etc/init.d/mysqld start \
    && mysql -u root -e "create database toybox;" \
    && mysql -u root -e "use toybox; create table toy (scan_id integer auto_increment primary key,ip_address text(255),port text(255),product text(255),version text(255),name text(255),cpe text(255),extrainfo text(255));"

COPY ./ /var/www/html
RUN chmod 664 /var/www/html/*.php

CMD ["supervisord", "-n"]

```

## REFER TO

####Docker hub
[nickistre/centos-lamp](https://github.com/nickistre/docker-lamp)

