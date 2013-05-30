phpremotecontrol
================

a basic web remote control written in php skined with twitter bootstrap

please note that this is not secure,
i m using this remote on my raspberry pi which is not exposed to the internet


if you want a minimalistic webserver, you can use php5-cli:

please check you have php >= 5.4

apt-get install php5-cli
mkdir /home/pi/remote/

#put index in /home/pi/remote/
#then launch
/usr/bin/php5 -S 0.0.0.0:80 -t /home/pi/remote/
