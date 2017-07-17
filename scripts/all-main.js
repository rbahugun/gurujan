	$(document).ready(function () {
		log.info("Hello world");
		$(function(){ $("#menu1").click(function() { log.info("Home : Home text displayed" );$('#center-body').load('../html/Home.html');	}); });
		$(function(){ $("#menu21").click(function() { log.info("Services : menuu21" );	$('#center-body').load('../html/div21.html');		}); });
		$(function(){ $("#menu22").click(function() { log.info("Services : menuu22" );	$('#center-body').load('../html/div22.html');		}); });
		$(function(){ $("#menu23").click(function() { log.info("Services : menuu23" );	$('#center-body').load('../html/div23.html');		}); });
		$(function(){ $("#menu31").click(function() { log.info("srch_tut : menuu31" );	$('#center-body').load('../html/tut_srch_form.html');}); });
		$(function(){ $("#menu32").click(function() { log.info("srch_stu : menuu32" );	$('#center-body').load('../html/stu_srch_form.html');}); });
		$(function(){ $("#menu4").click(function() { log.info("Contact : menuu4" );		$('#center-body').load('../html/contact_form.html');			}); });
		$(function(){ $("#menu5").click(function() { log.info("FAQ : menuu5" );			$('#center-body').load('../html/FAQ.html');			}); });
		$(function(){ $("#menu61").click(function() { log.info("Reg Tutor : menuu61" );	$('#center-body').load('../html/tut_reg_form.html');	}); });
		$(function(){ $("#menu62").click(function() { log.info("Reg Student : menuu62" );	$('#center-body').load('../html/stu_reg_form.html');	}); });
		$(function(){ $("#login").click(function() { log.info("Login Button" );$('#center-body').load('../html/login_form.html');	}); });
		
	});		
		

	$("#right-body").ready(
		function(){
				log.info("Loading Testimonials");
				log.info(loginuser);
				
				var showChar = 100;		var ellipsestext = "...";		var moretext = "more";		var lesstext = "less";
				$('.more').each(function() {
					var content = $(this).html();
					if(content.length > showChar) {
						var c = content.substr(0, showChar);
						var h = content.substr(showChar-1, content.length - showChar);
			 
						var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
						$(this).html(html);
					}
				});
			 
				$(".morelink").click(function(){
					if($(this).hasClass("less")) {
						$(this).removeClass("less");
						$(this).html(moretext);
					} else {
						$(this).addClass("less");
						$(this).html(lesstext);
					}
					$(this).parent().prev().toggle();
					$(this).prev().toggle();
					return false;
				});
	});
	
	$(document).ready(function(){
				log.info("login user to be printed");
				if (!(loginuser== '')) {($('#signin').html(loginuser));} else { ($('#signin').html("Visitor"));}
	});