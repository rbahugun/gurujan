var http = require('http');
var port = 9000;

httpServer = http.createServer(function(req, resp){
	
	resp.writeHead(200,{"Content-Type":"text/html"});
	resp.write("<html><body>Hello World</body></html>");
	resp.end();
}).listen(port, "127.0.0.1");
