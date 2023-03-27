cd .. &&
cd .. &&
docker rm poke-composer &&
docker run --name poke-composer -v $PWD/:/app composer install
#sh -f /home/anderson/Documentos/projetos/pokeapp/docker/composer/runComposer.sh