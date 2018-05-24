FROM centos:6.6
MAINTAINER Nicholas Istre <nicholas.istre@e-hps.com>

# install http
RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm

# install httpd
RUN yum -y install httpd vim-enhanced bash-completion unzip

# install mysql
RUN yum install -y mysql mysql-server
RUN echo "NETWORKING=yes" > /etc/sysconfig/network
# start mysqld to create initial tables
RUN service mysqld start

# install php
RUN yum install -y php php-mysql php-devel php-gd php-pecl-memcache php-pspell php-snmp php-xmlrpc php-xml

# install supervisord
RUN yum install -y python-pip && pip install "pip>=1.4,<1.5" --upgrade
RUN pip install supervisor

# install sshd
RUN yum install -y openssh-server openssh-clients passwd

RUN ssh-keygen -q -N "" -t dsa -f /etc/ssh/ssh_host_dsa_key && ssh-keygen -q -N "" -t rsa -f /etc/ssh/ssh_host_rsa_key 
RUN sed -ri 's/UsePAM yes/UsePAM no/g' /etc/ssh/sshd_config && echo 'root:changeme' | chpasswd

# Put your own public key at id_rsa.pub for key-based login.
RUN mkdir -p /root/.ssh && touch /root/.ssh/authorized_keys && chmod 700 /root/.ssh
#ADD id_rsa.pub /root/.ssh/authorized_keys


ADD phpinfo.php /var/www/html/
ADD supervisord.conf /etc/
EXPOSE 22 80 443

ENTRYPOINT ["supervisord"]

COPY clound_scan.php /var/www/html/
COPY del_new.php /var/www/html/
COPY scan.php /var/www/html/
COPY show.php /var/www/html/

RUN mysqladmin -u root password 123456
#RUN mysqladmin --user=root --password=123456 create toybox
#RUN mysql -u root -e "use toybox; create table toy (scan_id integer auto_increment primary key,ip_address text(255),port text(255),product text(255),version text(255),name text(255),cpe text(255),extrainfo text(255));"
