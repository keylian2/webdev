#/bin/sh

source ~/.bashrc

env

mysql -ukeylian -pkeylian9188 -Dkeylian < showtables.sql
