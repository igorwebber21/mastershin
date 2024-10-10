jQuery(function(){

  const sitename = location.protocol + "//" + location.hostname;  // 'http://master-shin'
  var docLoc = document.location.href;
  var route = docLoc.replace(sitename, ""); // '/?view=service'

  if(signupMode)
  {
    console.log('signupMode', signupMode);

    jQuery('.page-header, .page-footer, .modal-header .close').hide();
    jQuery('#appointmentForm').modal({backdrop: 'static', keyboard: false});
    jQuery('.appointment').attr('data-target', '0').css('cursor', 'default');
  }

  jQuery("#zapisDate").on('blur', function(){

    var zapisDate = jQuery(this).val(); // 26/11/2021
    jQuery("#zapisTime").val('');

    if(timeIntervals[zapisDate]){
      for (var z=0; z < timeIntervals[zapisDate].length; z++)
      {
        if(timeIntervals[zapisDate][z]["res"] === 0)
        {
          console.log(0);
          jQuery("#zapisTime option#time_" + timeIntervals[zapisDate][z]["time"].replace(":","")).attr("disabled", true);
        }
        else{
          jQuery("#zapisTime option#time_" + timeIntervals[zapisDate][z]["time"].replace(":","")).attr("disabled", false);
        }
      }
    }
    else{
      jQuery("#zapisTime option").attr("disabled", false);
    }
   /* jQuery("#zapisTime option").each(function(){
      var optionVal = jQuery(this).val();
      console.log(optionVal);
    });*/

  });

  jQuery('.nav-aside ul li').each(function() {

    var linkHref = jQuery(this).find('a').attr('href');

    if (linkHref === route) {
      jQuery(this).addClass('current');
    }
  });

  jQuery('.table-01-wrapper').scroll(function() {

    return false;
  });

  setTimeout(function(){
    jQuery(".mmpanel").prepend('<div class="logo">\n' +
      '    <a href="/">\n' +
      '        <img src="/images/logo.png" alt="Logo">\n' +
      '    </a>\n' +
          ' <span class="phone-number"> ' +
          '+38<span class="code">(050)</span>-866-56-07 ' +
          '<a style="font-weight: normal; color: #fff;" href="viber://chat?number=%2B380508665607">(Viber)</a> ' +
          '</span>' +
      '  </div>' +
    '<div class="header-lang">\n' +
      '                  <a href="/" lang="ua"> UA </a>\n' +
      '                  <span>|</span>\n' +
      '                  <a href="/ru" lang="ru"> RU </a>\n' +
      '                  <span>|</span>\n' +
      '                  <a href="/en" lang="en"> EN </a>\n' +
      '            </div>');

    setTimeout(function(){
      jQuery("#mobile-menu .header-lang a").each(function(){
        if(jQuery(this).attr('lang') == lang){
          jQuery(this).addClass('selected-lang');
        }
      });
    });
  },500);




  jQuery('ul#menu-primary-menu li').each(function() {

    var currItem =  jQuery(this);
    var linkHref = currItem.find('a').attr('href');
    //console.log(linkHref);

    if(linkHref === "#"){ // if dropdown

      var dropdownMenu = currItem.find(".dropdown-menu").html();
      jQuery(dropdownMenu + ' li').each(function() {
        var dropdownHref = jQuery(this).find('a').attr('href');

        if(dropdownHref === route){
          currItem.addClass('current-menu-item');
        }
      });
    }
    else{
      if (linkHref === route) {
        currItem.addClass('current-menu-item');
      }
    }


  });



  var textareaMessage = jQuery("div#textarea-message");
  if(textareaMessage.length !== 0){
    textareaMessage.html("<textarea id=\"contact-user-message\" name=\"contact-user-message\" cols=\"40\" rows=\"10\" " +
      "class=\"wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required input-full form-control\" " +
      "aria-required=\"true\" aria-invalid=\"false\" placeholder=\"" + dictMessage + "\" required></textarea>");
  }



  jQuery("#contactModalForm").submit(function(){

    var userName = jQuery("#modal-user-name").val();
    var userPhone = jQuery("#modal-user-phone").val();
    var userMessage = jQuery("#modal-user-message").val();
    var carModel = jQuery("#modal-car-model").val();
    var carNumber = jQuery("#modal-car-number").val();
    var zapisService = jQuery("#zapisService").val();
    var zapisServiceName = jQuery("#zapisService option:selected").text();
    var zapisDate = jQuery("#zapisDate").val();
    var zapisTime = jQuery("#zapisTime").val();

    jQuery.ajax({
      url: '/user/claim',
      type: 'POST',
      data: { userName: userName, userPhone: userPhone, userMessage: userMessage,
        zapisService: zapisService, zapisDate: zapisDate, zapisTime: zapisTime,
        carModel: carModel, carNumber: carNumber, zapisServiceName: zapisServiceName
      },
      beforeSend: function(){
        jQuery("#contactModalForm").addClass('submitting');
        jQuery("#contactModalForm .modal-send-btn").addClass('hide');
        jQuery("#contactModalForm .wpcf7-response-output").removeClass('form-error-color').hide();
      },
      success: function(res){
       setTimeout(function(){

         var result = JSON.parse(res);

         jQuery("#contactModalForm").removeClass('submitting');
         jQuery("#contactModalForm .modal-send-btn").removeClass('hide');
         jQuery("#contactModalForm .wpcf7-response-output").show().text(result.message);

         if(result.status === 1){
           jQuery("#contactModalForm")[0].reset();
         }
         else{
           jQuery("#contactModalForm .wpcf7-response-output").addClass('form-error-color');
         }
       }, 3000);

      },
      error: function(){
        alert("Error!");
      }
    });

    return false;
  });


  jQuery("#contactPageForm").submit(function(){

    var userName = jQuery("#contact-user-name").val();
    var userPhone = jQuery("#contact-user-phone").val();
    var userMessage = jQuery("#contact-user-message").val();

    jQuery.ajax({
      url: '/user/claim',
      type: 'POST',
      data: { userName: userName, userPhone: userPhone, userMessage: userMessage
      },
      beforeSend: function(){
        jQuery("#contactPageForm").addClass('submitting');
        jQuery("#contactPageForm .modal-send-btn").addClass('hide');
        jQuery("#contactPageForm .wpcf7-response-output").removeClass('form-error-color').hide();
      },
      success: function(res){
        setTimeout(function(){

          var result = JSON.parse(res);

          jQuery("#contactPageForm").removeClass('submitting');
          jQuery("#contactPageForm .contact-send-btn").removeClass('hide');
          jQuery("#contactPageForm .wpcf7-response-output").show().text(result.message);

          if(result.status === 1){
            jQuery("#contactPageForm")[0].reset();
          }
          else{
            jQuery("#contactPageForm .wpcf7-response-output").addClass('form-error-color');
          }
        }, 3000);

      },
      error: function(){
        alert("Error!");
      }
    });

    return false;
  });



  jQuery("body .phone-checker").mask("+38 (999) 999-99-99", {autoclear: false});

  jQuery(".phone-checker").click(function(){

    jQuery(this).focus();

  });

	/*jQuery(".footer-section02").hover(function(){

		var iframeBg = jQuery(this).find(".iframe-bg");
			iframeBg.fadeOut(1000);

	}, function(){

		var iframeBg = jQuery(this).find(".iframe-bg");
		iframeBg.fadeIn(1000);
	});*/
});
