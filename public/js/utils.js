
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
	getProjectJSON : function(that, callback)
	{
		var xhttp = new XMLHttpRequest();
		var q = that.value;
		xhttp.open('GET','/project/pcodeAjax/'+q,true);
		xhttp.responseType = "json";
		xhttp.onload = function(oEvent)
		{
			callback(xhttp.response);
		}
		xhttp.send();	
	},
	
	updateProjectCode : function(response)
	{
		var output = '';
		for(i=0; i < response.length; i++)
		{
			output += '<tr><td>' + (response[i].projectcode).toUpperCase() + '</td></tr>'; 
		}
		var tbody = document.querySelector('body > div > div > table > tbody');
		tbody.innerHTML = output;	
	},

	updateProjInfo : function(response)
	{
		var output = '';
		for(i=0; i < response.length; i++)
		{

			 output += '<tr><td style="cursor: pointer;" onclick="utilsProject.getSelected(this);" pid="'+response[i].id+'">'+  
			            (response[i].name) + '</td><td width="7%"><a href="/project/edit/'+(response[i].id)+
			            '" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>' +
			            '<td width="7%"><a href="/project/delete/'+ (response[i].id) +'" class="btn btn-default">'+
			            '<i class="glyphicon glyphicon-remove"></i> Delete</a></td></tr>';	
		}
		var tbody = document.querySelector('body > div > div > table > tbody');
		tbody.innerHTML = output;	
	},
	
	updateProjDownload : function(response)
	{
		var output = '';
		for(i=0; i < response.length; i++)
		{
			 output += '<tr><td>'+ (response[i].projectcode) + '</td><td>'+ (response[i].name) + 
			           '</td><td width="7%"><a href="/project/downloadProject/'+(response[i].id)+
			           '" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i>Download</a></td></tr>';	
		}
		var tbody = document.querySelector('body > div > div > table > tbody');
		tbody.innerHTML = output;	
	}
	
	
}

var siteboss =
{
	getSitesJSON : function(that,callback)
	{
		var xhttp = new XMLHttpRequest();
		var q = that.value;
		var role = that.getAttribute("role");
		xhttp.open('GET','/siteboss/projSiteAjax/0/'+q,true);
		xhttp.responseType = "json";
		xhttp.onload = function(oEvent)
		{
			callback(xhttp.response, role);
		}
		
		xhttp.send();	
	},
	
	updateSiteNN : function(response,role)
	{
		var output = '';
		for(i=0; i < response.length; i++)
		{
			output += '<tr><td style="cursor: pointer;" onclick="utilsProject.getSelected(this);" pid="'+response[i].UniqueID+'">'+  
			response[i].SiteID + ' - ' + response[i].SiteName + '</td>';
			if(role == 'admin') //if Admin
			{
				output += '<td width="7%"><a href="/siteboss/edit/'+(response[i].UniqueID)+
						'" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>' +
						'<td width="7%"><a href="/siteboss/delete/'+ (response[i].UniqueID) +'" class="btn btn-default">'+
						'<i class="glyphicon glyphicon-remove"></i> Delete</a></td>';
			}
			output+='</tr>';	
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

