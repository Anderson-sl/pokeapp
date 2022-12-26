echo "Executando importação do Dump base" &&
psql -U postgres postgres < /var/www/docker/db/dump/dump.sql
