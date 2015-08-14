//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ cashier ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
$(document).ready(function(){
    //console.log('test');
   // $("#depositAmount").numeric();
   // $("#deposit_amount").numeric();   
   // $("#lastFiveDigitNo").numeric();   
   // $("#depositAccountNo").numeric();   
   // $("#bank_account_number").numeric();
   // $("#amount").numeric();
   // $("#depositTransactionRef").numeric();

   //check promo for auto 3rd party deposit
   //if($("#" + 'paypalSuccessDepositAmount').length == 0){
   //   checkPromoNow($("#paypalSuccessDepositAmount").val(),$("#depositPromoId").val());
   //}
   
   //local bank deposit
   $('#bankName').prop('disabled', true);
   $('#fullName').prop('disabled', true);
   $('#depositAccountNo').prop('disabled', true);
   $('#rememberMyAccount_cb').prop('disabled', true);

   //clear fields first
   $('#fullName').val('');
   $('#bankName').val('');
   $('#depositAccountNo').val('');

   $('#preferredAccount_rb').change(function() {
  	  $('#preferredBank').prop('disabled', false);
  	  $('#preferredBank').prop('required', true);

  	  $('#fullName').prop('disabled', true);
  	  $('#bankName').prop('disabled', true);
  	  $('#depositAccountNo').prop('disabled', true);
      $('#rememberMyAccount_cb').prop('disabled', true);
  	  //$('#withdraw_rememberMyAccount_cb').prop('disabled', true);

  	  $('#fullName').val('');
  	  $('#bankName').val('');
  	  $('#depositAccountNo').val('');
   });

	$('#newAccount_rb').change(function() {
	  $('#preferredBank').prop('disabled', true);
	  $('#preferredBank').prop('required', false);

	  $('#fullName').prop('disabled', false);
	  $('#bankName').prop('disabled', false);
	  $('#depositAccountNo').prop('disabled', false);
      $('#rememberMyAccount_cb').prop('disabled', false);
      //$('#withdraw_rememberMyAccount_cb').prop('disabled', false);
	});

	$("[data-toggle='popover']").popover({
        html: 'true',
        template: '<div class="popover"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"></div><div class="popover-footer"><h6>Do you need assistance?</h6></div></div>'
    });

  $(".number_only").keydown(function (e) {
        var code = e.keyCode || e.which;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(code, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A
            (code == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (code >= 35 && code <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (code < 48 || code > 57)) && (code < 96 || code > 105)) {
            e.preventDefault();
        }
    });

    $(".amount_only").keydown(function (e) {
        var code = e.keyCode || e.which;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(code, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (code == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (code >= 35 && code <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (code < 48 || code > 57)) && (code < 96 || code > 105)) {
            e.preventDefault();
        }
    });

    $(".letters_only").keydown(function (e) {
        var code = e.keyCode || e.which;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(code, [46, 8, 9, 27, 32, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (code == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (code >= 35 && code <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if (e.ctrlKey === true || code < 65 || code > 90) {
            e.preventDefault();
        }
    });

    $(".letters_numbers_only").keydown(function (e) {
        var code = e.keyCode || e.which;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(code, [46, 8, 9, 27, 32, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (code == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (code >= 35 && code <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (code < 48 || code > 57)) && (code < 96 || code > 105) && (e.ctrlKey === true || code < 65 || code > 90)) {
            e.preventDefault();
        }
    });

    $(".usernames_only").keydown(function (e) {
        var code = e.keyCode || e.which;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(code, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A
            (code == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (code >= 35 && code <= 40) ||
             // Allow: underscores
            (e.shiftKey && code == 189)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (code < 48 || code > 57)) && (code < 96 || code > 105) && (e.ctrlKey === true || code < 65 || code > 90)) {
            e.preventDefault();
        }
    });

    $(".emails_only").keydown(function (e) {
        var code = e.keyCode || e.which;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(code, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (code == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (code >= 35 && code <= 40) ||
             //Allow: Shift+2
            (e.shiftKey && code == 50)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (code < 48 || code > 57)) && (code < 96 || code > 105) && (e.ctrlKey === true || code < 65 || code > 90)) {
            e.preventDefault();
        }
    });
});

// function checkPromoNow(depositAmount,depositPromoId){
//   console.log('depositAmount: '+depositAmount+' depositPromoId: '+depositPromoId);
//   $.ajax({
//             'url' : base_url +'smartcashier/verifyPromoViaAjax/'+depositAmount+'/'+depositPromoId,
//             'type' : 'GET',
//             'dataType' : "json",
//             'success' : function(data){
//                         console.log('success promo check!');
                           
//                         }
//        },'json');
//         return false;
// }

function preferredAccount() {

    console.log('preferred account');
    document.getElementById('bank_name').disabled = true;
    document.getElementById('bank_account_fullname').disabled = true;
    document.getElementById('bank_account_number').disabled = true;
    document.getElementById('province').disabled = true;
    document.getElementById('city').disabled = true;
    document.getElementById('branch').disabled = true;
    //document.getElementById('rememberMyAccount_cb').disabled = true;
    document.getElementById('withdraw_rememberMyAccount_cb').disabled = true;
    document.getElementById('preferred_account').disabled = false;

    //clear fields first
   $('#bank_name').val('');
   $('#bank_account_fullname').val('');
   $('#bank_account_number').val('');
   $('#province').val('');
   $('#city').val('');
   $('#branch').val('');
}

function newAccount() {
    console.log('new account');
    document.getElementById('bank_name').disabled = false;
    document.getElementById('bank_account_fullname').disabled = false;
    document.getElementById('bank_account_number').disabled = false;
    document.getElementById('province').disabled = false;
    document.getElementById('city').disabled = false;
    document.getElementById('branch').disabled = false;
    //document.getElementById('rememberMyAccount_cb').disabled = false;
    document.getElementById('withdraw_rememberMyAccount_cb').disabled = false;
    document.getElementById('preferred_account').disabled = true;
}
var base_url = "http://"+window.location.hostname+"/";
var imgloader = "http://" + window.location.hostname + "/resources/images/ajax-loader.gif";

function setURL(value) {
    var val = value;
    var res = val.split("\\");
    console.log('res: '+res);

    document.getElementById('banner_url').value = base_url + 'resources/images/depositslip/' + res[2];
}

function GetXmlHttpObject() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject) {
        // code for IE6, IE5
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function depositHistory(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "smartcashier/depositHistory/" + segment;

    var div = document.getElementById("depositHistory");

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            div.innerHTML = xmlhttp.responseText;
        }

        if (xmlhttp.readyState != 4) {
            div.innerHTML = '<table class="table table-hover"><tr><td align="center" valign="middle" style="border:0; height:358px; width: 220px; text-align: center; font-size: 11px"><img src="' + imgloader + '"><br/>Loading. Please wait.</td></tr></table>';
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function withdrawalHistory(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "smartcashier/withdrawalHistory/" + segment;

    var div = document.getElementById("withdrawalHistory");

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            div.innerHTML = xmlhttp.responseText;
        }

        if (xmlhttp.readyState != 4) {
            div.innerHTML = '<table class="table table-hover"><tr><td align="center" valign="middle" style="border:0; height:358px; width: 220px; text-align: center; font-size: 11px"><img src="' + imgloader + '"><br/>Loading. Please wait.</td></tr></table>';
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function cashbackHistory(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "smartcashier/cashbackHistory/" + segment;

    var div = document.getElementById("cashbackHistory");

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            div.innerHTML = xmlhttp.responseText;
        }

        if (xmlhttp.readyState != 4) {
            div.innerHTML = '<table class="table table-hover"><tr><td align="center" valign="middle" style="border:0; height:358px; width: 220px; text-align: center; font-size: 11px"><img src="' + imgloader + '"><br/>Loading. Please wait.</td></tr></table>';
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function transferHistory(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "smartcashier/transferHistory/" + segment;

    var div = document.getElementById("transferHistory");

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            div.innerHTML = xmlhttp.responseText;
        }

        if (xmlhttp.readyState != 4) {
            div.innerHTML = '<table class="table table-hover"><tr><td align="center" valign="middle" style="border:0; height:358px; width: 220px; text-align: center; font-size: 11px"><img src="' + imgloader + '"><br/>Loading. Please wait.</td></tr></table>';
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function balanceAdjustmentHistory(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "smartcashier/balanceAdjustmentHistory/" + segment;

    var div = document.getElementById("balanceAdjustmentHistory");

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            div.innerHTML = xmlhttp.responseText;
        }

        if (xmlhttp.readyState != 4) {
            div.innerHTML = '<table class="table table-hover"><tr><td align="center" valign="middle" style="border:0; height:358px; width: 220px; text-align: center; font-size: 11px"><img src="' + imgloader + '"><br/>Loading. Please wait.</td></tr></table>';
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}



