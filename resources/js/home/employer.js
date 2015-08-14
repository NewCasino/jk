function get_jobs_home_page(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "employers/get_jobs/" + segment;

    var div = document.getElementById("jobs_table");

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

function get_fljobs_home_page(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "employers/get_fljobs/" + segment;

    var div = document.getElementById("fljobs_table");

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

function flJobList(segment) {
    var xmlhttp = GetXmlHttpObject();

    if (xmlhttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    url = base_url + "employers/get_fljobs/" + segment;

    var div = document.getElementById('fljobs_table');

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

//tooltip
$('body').tooltip({
    selector: '[data-toggle="tooltip"]'
});

// var notAvailBtn = document.getElementById("notAvailBtn");
 //notAvailBtn.hide();
$('#notFLAvailBtn').show();
function checkAvailFL() {
    var flPromo1 = document.getElementById("flPromo1");
    var flPromo2 = document.getElementById("flPromo2");
    var flPromo3 = document.getElementById("flPromo3");
    var flPromo4 = document.getElementById("flPromo4");
    var flPromo5 = document.getElementById("flPromo5");
    var flPromo6 = document.getElementById("flPromo6");
    
    if (flPromo1.checked == true || flPromo2.checked == true || flPromo3.checked == true || flPromo4.checked == true || flPromo5.checked == true || flPromo6.checked == true)
    {
        $('#notFLAvailBtn').hide();
    }
    else
    {
        $('#notFLAvailBtn').show();
    }
}

 // for notification board
  $("#notificationDashboard-joblist").click(function () {
        $('.notificationDashboard').removeClass('notDboard-active');
        $(this).addClass('notDboard-active');
        $('#dwStatus').val('request');
  });
  
  $("#notificationDashboard-freelancejoblist").click(function () {
        $('.notificationDashboard').removeClass('notDboard-active');
        $(this).addClass('notDboard-active');
        $('#dwStatus').val('approved');
  });

  $("#notificationDashboard-savedresume").click(function () {
        $('.notificationDashboard').removeClass('notDboard-active');
        $(this).addClass('notDboard-active');
        $('#dwStatus').val('declined');
  });

  $("#notificationDashboard-shortlisted").click(function () {
        $('.notificationDashboard').removeClass('notDboard-active');
        $(this).addClass('notDboard-active');
        $('#dwStatus').val('declined');
  });

$(document).ready(function() { // hide/show for add
    $("#button_list_toggle1").click(function(){
        $("#list_panel_body1").slideToggle();
        $("#button_span_list_up1",this).toggleClass("glyphicon glyphicon-chevron-up glyphicon glyphicon-chevron-down");
    });

    $("#button_list_toggle2").click(function(){
        $("#list_panel_body2").slideToggle();
        $("#button_span_list_up2",this).toggleClass("glyphicon glyphicon-chevron-up glyphicon glyphicon-chevron-down");
    });

    $("#button_list_toggle3").click(function(){
        $("#list_panel_body3").slideToggle();
        $("#button_span_list_up3",this).toggleClass("glyphicon glyphicon-chevron-up glyphicon glyphicon-chevron-down");
    });

    $("#button_list_toggle4").click(function(){
        $("#list_panel_body4").slideToggle();
        $("#button_span_list_up4",this).toggleClass("glyphicon glyphicon-chevron-up glyphicon glyphicon-chevron-down");
    });

    $("#button_list_toggle5").click(function(){
        $("#list_panel_body5").slideToggle();
        $("#button_span_list_up5",this).toggleClass("glyphicon glyphicon-chevron-up glyphicon glyphicon-chevron-down");
    });

    $("#button_list_toggle6").click(function(){
        $("#list_panel_body6").slideToggle();
        $("#button_span_list_up6",this).toggleClass("glyphicon glyphicon-chevron-up glyphicon glyphicon-chevron-down");
    });
});