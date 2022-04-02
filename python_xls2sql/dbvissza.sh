#!/bin/bash

/usr/bin/mysql -u root --port 3307 -h ds718 tanchaz19 --password=qwe <dbback.sql
echo "Adatok visszaállítva."
rm dbback.sql
echo "dbback.sql file törölve."
read
