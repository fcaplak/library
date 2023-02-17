FROM node:19.6.0-alpine3.17

WORKDIR /app

COPY ./package.json ./
RUN npm i
COPY . .

ENTRYPOINT npm start

EXPOSE 9000