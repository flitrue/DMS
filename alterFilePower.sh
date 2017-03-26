#!/bin/sh

#删除缓存文件夹
echo "删除缓存文件"
rm -rf ./DMS/Runtime

#新建Runtime文件夹并设置可写
echo "创建Runtime文件夹"
mkdir ./DMS/Runtime
chmod 777 ./DMS/Runtime

#设置Public文件夹下的*为可写
export myPublic="./Public/"
echo "判断Public文件夹是否存在"
if [ ! -d $myPublic ] ;then
	echo “public不存在”
	mkdir $myPublic
fi
echo "授权Public下的所有文件夹"

chmod -R 777 ./Public/*

#设置/var/lib/nginx目录可写
echo "设置/var/lib/nginx目录可写"
chmod -R 775 /var/lib/nginx/
