#!/bin/bash
## auto install nginx, php,mysql

### global var end

echo "start......"

if [ $(id -u != "0") ];then
    echo "error! not root user"
    exit;
fi

## 环境检测
ifcentos=$(cat /proc/version | grep centos)

if [ "$ifcentos" =="" ] ;then
    echo "error! just use in centos"
    exit;
fi

echo "kill proccess......"
## 判断是否处于运行状态
systemctl stop nginx.service
systemctl stop php-fpm.service
systemctl stop mysql.service
killall mysqld &> /dev/null
killall nginx &> /dev/null
killall php-fpm &> /dev/null

echo "remove......"
## if exit nginx php mysql remove
## 清理环境
for i in $(rpm -qa| grep nginx|grep= -v grep)
do 
    echo "remove nginx =>"$i
    rpm -e --nodeps $i
done

for i in $(rpm -qa| grep php|grep= -v grep)
do 
    echo "remove php =>"$i
    rpm -e --nodeps $i
done

for i in $(rpm -qa| grep mysql|grep= -v grep)
do 
    echo "remove mysql =>"$i
    rpm -e --nodeps $i
done


## install
echo "install begin......"

echo "install nginx..."
yum -y install epel-release
yum -y install nginx

systemctl enable nginx.service;
# systemctl start nginx.service;

echo "install php..."

yum -y install php php-fpm php-opcache
yum -y install php-mysql php-mcrypt php-mbstring php-gd php-devel php-pdo php-soap

rpm -qa | grep php | grep -v grep 

systemctl enable php-fpm.service;

echo "install mysql..."

wget http://repo.mysql.com/mysql-community-release-el7-5.noarch.rpm
rpm -ivh mysql-community-release-el7-5.noarch.rpm
yum -y install mysql  mysql-server


## install
echo "install ok......"

## config
echo "config nginx......"

groupadd www  
useradd -g www www  

## nginx的用户组
sed -i 's/user nginx/user www/g' /etc/nginx/nginx.conf

# https证书配置

cp -r ./cert/ /

## php的用户组
echo "config php......"
cp ./key/dms.conf /etc/nginx/conf.d/

systemctl start nginx.service;
systemctl start php-fpm.service;
systemctl start mysqld.service

echo "config end"

echo "setting firewalld..."

echo "start firewall"

systemctl start firewalld
firewall-cmd --list-all
firewall-cmd --zone=public --add-port=80/tcp --permanent
firewall-cmd --zone=public --add-port=443/tcp --permanent
firewall-cmd --reload

