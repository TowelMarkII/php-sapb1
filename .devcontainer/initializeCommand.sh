echo "Running in linux environment"
if ! test -f ../.secrets.env
then 
    echo "Did not find .secrets.env. Will create empty one."
    touch ../.secrets.env
else
    echo "Found .secrets.env. Will not touch it."
fi
