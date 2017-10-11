var io = require('socket.io')(3000, {
   origins : 'localhost:82:*'
});

var Redis = require('ioredis'),
    redis = new Redis();


redis.psubscribe('*', function (error, count) {


});

redis.on('pmessage', function (subscribed, chanel, message) {
   console.log(message);
   message = JSON.parse(message);
   io.emit(chanel + ':' + message.event, message.data);

});

console.log("hello");

