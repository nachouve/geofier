#!/bin/bash

## Script to prepared data to test Geofier.

### DATABASES
BASE_PATH='/var/tmp/geofier/test/'
SQLITE_DB=$BASE_PATH'test_db.sqlite'

### CSV ONLINE
CSV_WEB=http://abertos.xunta.es/catalogo/cultura-ocio-deporte/-/dataset/0247/museos-coleccions-visitables-sistema-galego/001/descarga-directa-ficheiro.csv
CSV_FILE_IN=/tmp/foo_data.csv
CSV_FILE_OUT=/tmp/bar_data.csv

CREATE_STMT='/tmp/create.sql'
INSERT_STMT='/tmp/inserts.sql'

#wget $CSV_WEB --output-document $CSV_FILE_IN'_2'
cat $CSV_FILE_IN'_2' | iconv -f latin1 > $CSV_FILE_IN

# Copy coords
sed 1d $CSV_FILE_IN | awk -F';' '{print $12}' | tr ',' ' ' > /tmp/coords.txt

cat /tmp/coords.txt | cs2cs +proj=longlat +ellps=WGS84 +datum=WGS84 +no_defs +to +proj=utm +zone=29 +ellps=intl +units=m +no_defs -r -E > /tmp/coords2.txt

echo "LAT;LONG;COORDX;COORDY" > /tmp/coords.csv
cat /tmp/coords2.txt |  awk '{print $1";"$2";"$3";"$4}' | sed s/' '/''/g >> /tmp/coords.csv

python -c '
f1 = open("'$CSV_FILE_IN'")
f2 = open("/tmp/coords.csv")
f3 = open("'$CSV_FILE_OUT'", "w")
for line in f1.readlines():
  f3.write(line.strip()+";"+f2.readline().strip()+"\n")
f3.close()
f2.close()
f1.close()
'

## Prepare CREATE TABLE statement
FIELD_LIST=$(sed -n 1p $CSV_FILE_OUT \
	| sed 'y/āáǎàēéěèīíǐìōóǒòūúǔùǖǘǚǜĀÁǍÀĒÉĚÈĪÍǏÌŌÓǑÒŪÚǓÙǕǗǙǛ/aaaaeeeeiiiioooouuuuüüüüAAAAEEEEIIIIOOOOUUUUÜÜÜÜ/' \
	| tr ' ' '_' | sed s/';'/','/g )

echo $FIELD_LIST | sed s/','/' text, '/g > /tmp/sql1
echo 'create table test_table ('`cat /tmp/sql1`'  text);' > $CREATE_STMT

NUM_FIELDS=$(sed -n 1p bar_data.csv | tr ';' '\n' | wc -l)

INSERT_1=$(echo 'insert into test_table ('

rm $SQLITE_DB
sqlite3 $SQLITE_DB < $CREATE_STMT

  
rm $CSV_FILE_IN /tmp/coords*.txt /tmp/sql1
