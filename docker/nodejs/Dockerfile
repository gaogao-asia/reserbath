FROM node:8.15.0-alpine
ENV APP_ROOT /usr/src/reserbath-web

RUN mkdir -p $APP_ROOT
WORKDIR $APP_ROOT

COPY package.json $APP_ROOT
COPY package-lock.json $APP_ROOT

RUN apk add --update --no-cache \
    git \
    && \
    npm install

COPY . $APP_ROOT
