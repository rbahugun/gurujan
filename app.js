var http = require('http');
var url = require('url');
var path = require('path');
var fs = require('fs');
var port = 9000;

httpServer = http.createServer(function(req, resp){
	
	    var fileStream = fs.readFile("C:\\Rama\\gurujan\\txt\\test-nodejs.html", 'utf8',function (err,data) {
	    	  if (err) {
	    		    return console.log(err);
	    		  }
	    		  console.log(data);
	    		  resp.write(data);
	    			resp.end();
	    		} );
		
	}).listen(port, "127.0.0.1");
