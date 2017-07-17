var http = require('http');
var url = require('url');
var path = require('path');
var fs = require('fs');
var port = 9000;

httpServer = http.createServer(function(req, resp){

		console.log(req.url);
		var uri = url.parse(req.url).pathname;
		console.log(uri);
		//var filename = path.join(process.cmd, unescape(uri));
		//console.log(filename);
		
		switch(req.url) {
			case "/contact": filename = "C:\\Rama\\gurujan\\txt\\test-nodejs.html"
				break;
			case "/faq": filename = "C:\\Rama\\gurujan\\index.html"
				break;
			default: filename = "C:\\Rama\\gurujan\\index.html"
			break;
	}	
	    var fileStream = fs.readFile(filename, 'utf8',function (err,data) {
	    	  if (err) {
	    		    return console.log(err);
	    		  }
	    		  console.log(data);
	    		  resp.write(data);
	    			resp.end();
	    		} );
		
	}).listen(port, "127.0.0.1");

