#/bin/sh

source ~/.bashrc

mysql -ukeylian -p  -Dkeylian < showtables.sql
