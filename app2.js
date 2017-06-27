/**
 * 
 */
	var MongoClient = require('mongodb').MongoClient, assert = require('assert');
	// Connection URL
	var url = 'mongodb://localhost:27017/gurujan';

	DBInteract();
  
    function DBInteract(){
		// Use connect method to connect to the Server
		MongoClient.connect(url, function(err, db) {
		  assert.equal(null, err);
		  console.log("Connected correctly to server");
		  var Obj = { name : "name2",  email: "email2",  message: "message2" };
		  console.log(Obj.name);
		  insertContacts (db, Obj, function(){
			    	db.close();	});
		});  }

  var insertContacts = function( db, Obj, callback ) {
	  var collection = db.collection('contacts');

	  collection.insertOne({
	  "contacts" :{
		  "name" : Obj.name,
		  "email": Obj.email,
		  "message": Obj.message
	  	}
	  	}, function(err, result) {
	  		assert.equal(err, null);
	    	console.log("Insert One Contact worked");
		    callback(result);
		});
  };

