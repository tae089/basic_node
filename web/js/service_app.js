var io = require('socket.io').listen(8080);

io.on('connection', function (socket) {
  //socket.emit('news', { hello: 'world' });
  socket.on('add', function (data) {
    console.log(data);
    io.emit('addOK','addOK');
  });
});
