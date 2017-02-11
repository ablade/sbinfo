
var Profile = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
        if (SignUp.check("name") == false) {
            return false;
        }
        if (SignUp.check("email") == false) {
            return false;
        }
        $("#profileForm")[0].submit();
    }
};

var SignUp = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
		
		if (SignUp.check("company_id") == false) {
            return false;
        }
        if (SignUp.check("name") == false) {
            return false;
        }
        if (SignUp.check("username") == false) {
            return false;
        }
        if (SignUp.check("email") == false) {
            return false;
        }
        
        if(!$('#id'))
        {
			if (SignUp.check("password") == false) {
				return false;
			}
			
			if ($("#password")[0].value != $("#repeatPassword")[0].value) {
				$("#repeatPassword")[0].focus();
				$("#repeatPassword_alert").show();

				return false;
			}
		}
        $("#registerForm")[0].submit();
    }
}

var utilsProject =
{
	getSelected : function(that)
	{
		$(".selected").removeClass("selected");
		that.classList.add("selected");
		$("#noSelectAlert").hide();
		return;
	},
	
	gotoSelectedId : function(controller, action)
	{
		var sel = $(".selected");
		if(sel[0])
		{
			window.location = '/'+controller+'/'+action+'/' + sel[0].getAttribute("pid");
		}else
		{
			$("#noSelectAlert").show();
		}
		
	},
	
	gotoLocation(path)
	{
		window.location = path;
	}
}

var company =
{
	getVendorCode : function(that)
	{
		var xhttp = new XMLHttpRequest();
		var q = that.value;
		xhttp.open('GET','/company/vcodeAjax/'+q,true);
		xhttp.responseType = "json";
		xhttp.onload = function(oEvent)
		{
			company.updateVendorCode(xhttp.response);
		}
		
		xhttp.send();	
	},
	
	updateVendorCode : function(response)
	{
		var output = '';
		for(i=0; i < response.length; i++)
		{
			output += '<tr><td>' + (response[i].vendor_code).toUpperCase() + '</td><td>' + response[i].name + '</td></tr>'; 
		}
		var tbody = document.querySelector('body > div > div > table > tbody');
		tbody.innerHTML = output;	
	}
	
	
	
	
}

var project =
{
	getProjectCode : function(that)
	{
		debugger;
		var xhttp = new XMLHttpRequest();
		var q = that.value;
		xhttp.open('GET','/project/pcodeAjax/'+q,true);
		xhttp.responseType = "json";
		xhttp.onload = function(oEvent)
		{
			project.updateProjectCode(xhttp.response);
		}
		
		xhttp.send();	
	},
	
	updateProjectCode : function(response)
	{
		debugger;
		var output = '';
		for(i=0; i < response.length; i++)
		{
			output += '<tr><td>' + (response[i].projectcode).toUpperCase() + '</td></tr>'; 
		}
		var tbody = document.querySelector('body > div > div > table > tbody');
		tbody.innerHTML = output;	
	}
	
	
	
	
}


$(document).ready(function () {
    $("#registerForm .alert").hide();
    $("div.profile .alert").hide();
    $("#noSelectAlert").hide();
});

