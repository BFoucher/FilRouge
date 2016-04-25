'use strict';

// Getting server, socket and redis
var app = require('express')();
var http = require('http').Server(app);
var server = require('http').createServer();
var io = require('socket.io').listen(server);
var redis2 = require('redis');
var clientRedis = redis2.createClient();

clientRedis.subscribe("notification");
clientRedis.subscribe("symfoEvent");

// Socket connexion
io.on('connection', function(socket){
    clientRedis.on("message", function(channel, message){
        socket.emit('notification',message);
    });
});


server.listen(8081, '127.0.0.1');