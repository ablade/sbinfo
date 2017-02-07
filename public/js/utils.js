
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

$(document).ready(function () {
    $("#registerForm .alert").hide();
    $("div.profile .alert").hide();
    $("#noSelectAlert").hide();
    $('#sbdetails').hide();
});
