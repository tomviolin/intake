all: build run
build:
	docker build -t intake .

run:
	docker kill intake || echo ""
	docker rm intake || echo ""
	docker run --name intake -d --restart always -p 8883:80 intake

