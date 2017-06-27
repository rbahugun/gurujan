	var loginuser='';
		$(document).ready(function () {
			$('#contact_submit').click(function(event) {
				event.preventDefault();		log.info("Data Loaded: $contact_form" );
				$.ajax( { type: "POST",		url: 'site/contact.php', 		data: $(contact_form).serialize(),	dataType: 'text',
					success: function(data) { $('#contact_formsuccess').html(data);	},
					error:function(){$('#contact_formsuccess').html('Failed.');	}	}); return false; });
					
			$('#login_submit').click(function(event) {
				event.preventDefault();		log.info ("login1");
				$.ajax( { type: "POST",		url: 'site/login.php',	data: $(login_form).serialize(), 	dataType: 'text',
					success: function(data) { log.info ("login2");	response = JSON.parse(data);
						if(response.isSuccess) { log.info(response.isSuccess);	$('#formsuccess_failure').html(response.table);
				if (!(response.loginid=='')) {($('#signin').html(response.loginid));} else { ($('#signin').html("Visitor1"));}}
							else { log.info("Nothing"); $('#formsuccess_failure').html('Incorrect Login or Password.'); }},
					error:function(){$('#formsuccess_failure').html('Service Failed. Please try again after sometime.'); } }); return false; });

			$('#tut_reg_submit').click(function(event) {
				event.preventDefault();		log.info("cr_tut_reg : 2" );
				$.ajax( { type: "POST",		url: 'site/cr_tut_reg.php', 	data: $(tut_reg_form).serialize(), 		dataType: 'text',
						success: function(data) { log.info("cr_tut_reg : 3") ;response = JSON.parse(data); log.info(response.table);$('#formsuccess_failure').html(response.table);},
						error:function(){ $('#formsuccess_failure').html('Failed.'); } }); return false;	});

			$('#stu_reg_submit').click(function(event) {
				event.preventDefault();		log.info("cr_stu_reg : 2" );
				$.ajax( { type: "POST",		url: 'site/cr_stu_reg.php', 	data: $(stu_reg_form).serialize(), 		dataType: 'text',
						success: function(data) { response = JSON.parse(data); $('#formsuccess_failure').html(response.table);},
						error:function(){ $('#formsuccess_failure').html('Failed.'); } }); return false;	});

			$('#tut_srch_submit').click(function(event) {
				event.preventDefault();		log.info("Tutor Search : 1" );
				$.ajax( { type: "POST",		url: 'site/tut_srch.php', 		data: $(tut_srch_form).serialize(), 		dataType: 'text',
					success: function(data) { response = JSON.parse(data); log.info (response.isSuccess);	log.info (response.table);
						if(response.isSuccess) { log.info(response.isSuccess);	$('#formsuccess_failure').html(response.table);}
							else{ log.info("Nothing"); $('#formsuccess_failure').html('No results found. Please change your search criteria.');}},
					error:function(){ $('#formsuccess_failure').html('Service Failed. Please try again after sometime.'); } }); return false; });

			$('#stu_srch_submit').click(function(event) {
				event.preventDefault();		log.info("stuor Search : 1" );
				$.ajax( { type: "POST",		url: 'site/stu_srch.php', 		data: $(stu_srch_form).serialize(), 		dataType: 'text',
					success: function(data) { response = JSON.parse(data); log.info (response.isSuccess);	log.info (response.table);
						if(response.isSuccess) { log.info(response.isSuccess);	$('#formsuccess_failure').html(response.table);}
							else{ log.info("Nothing"); $('#formsuccess_failure').html('No results found. Please change your search criteria.');}},
					error:function(){ $('#formsuccess_failure').html('Service Failed. Please try again after sometime.'); } }); return false; });

//			$('#cancel_button').click(function() { log.info("Cancel");$('#center-body').load('site/home.php');});
		});		

