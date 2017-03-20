<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Test Socket
    </title>
</head>

<body>
<h1>Look at the console</h1>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.7/socket.io.min.js"></script>
<script>
    var socket = io('http://138.68.93.20:3000');
    var app = new Vue({
        el: 'body',
        data: {
            users: []
        },
        ready: function () {
            socket.on('users', function (data) {
                console.log(data);
            }.bind(this));
        }
    });
</script>
</body>
</html>