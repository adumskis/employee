# Employee management API

## Running locally using Docker
Sometimes we all get a bit lazy. So, to save at least 200 ms every time there is a need to spin up a project, I always 
prepare makefile with all basic commands. What is more, nobody likes to remember docker container ports. That's why we 
will need to update local `/etc/hosts` file with static Nginx container IP address.

### Requirements:
* Docker (tested using v19.03);
* Docker-compose (tested using v1.26);

### Steps:
* Add `172.26.154.2 employee.local` to the `/etc/hosts` file;
* Create environment file `cp .env.example .env`;
* Spin up containers `make up`;
* Run migration `make artisan_migrate`;
* Visit [employee.local](http://employee.local/) using your browser;
* Have fun!

### Other stuff:
* To run phpunit test just use `make phpunit` command;
