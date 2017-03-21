# Personal Notes

To Run:

Navigate to the project directory using docker quickstart terminal.

- To build from Dockerfile
```bash
docker build -t php-test .
```
(`php-test` is the name for the docker image being built here)

- To run a container:
```bash
docker run -p 80:80 -v $(pwd):/var/www/html -it php-test
```

- To run commands inside the container run `EXEC` from Kitematic, or use the `docker exec` command.
