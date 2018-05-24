FROM nickistre/centos-lamp

COPY clound_scan.php /var/www/html/
COPY del_new.php /var/www/html/
COPY scan.php /var/www/html/
COPY show.php /var/www/html/

RUN mysql -u root --password= -e "create database toybox;"
RUN /n
#RUN mysql -u root -e "use toybox; create table toy (scan_id integer auto_increment primary key,ip_address text(255),port text(255),product text(255),version text(255),name text(255),cpe text(255),extrainfo text(255));"
