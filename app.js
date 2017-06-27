var http = require('http');
var url = require('url');
var path = require('path');
var fs = require('fs');
var port = 9000;

httpServer = http.createServer(function(req, resp){
	
//		var uri = url.parse(req.url).pathname;
//		var filename = path.join(process.cmd, unescape(uri));
	    var fileStream = fs.readFile("C:\\Rama\\gurujan\\txt\\test-nodejs.html", 'utf8',function (err,data) {
	    	  if (err) {
	    		    return console.log(err);
	    		  }
	    		  console.log(data);
	    		  resp.write(data);
	    			resp.end();
	    		} );
		
//	    fileStream.pipe(resp);
//		resp.writeHead(200,{"Content-Type":"text/html"});
//		resp.write("<html><body>Hello World</body></html>");
	}).listen(port, "127.0.0.1");

//switch(req.url) {
//		case "contact": contact.method();
//			break;
//		case "faq":
//			break;
//		case "login":
//			break;
//		case "tut-reg":
//			break;
//		case "stu-reg":
//			break;
//		case "tut-srch":
//			break;
//		case "stu-srch":
//			break;
//		default:
//			break;
//	}	
//
//function method (req.method){
//	
//	switch( req.method){
//		case "GET":  
//			break;
//		case "POST": this.post();
//			break;
//		case "DELETE":
//			break;
//		case "UPDATE":
//			break;
//		default:
//			break;
//	}
//}
//

