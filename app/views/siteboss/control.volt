{{ content() }}
<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
}
</style>
<h3 align ="center"> {{ sbName.SiteName }} </h3>
<div id="sbdetails" style="display: none;">
	<div align="left">
		<textarea disabled rows="20" style="width:100%;">

		{% for key,value in sbName %}
		{{ key }} : {{ value }}&#13;
		{% endfor %}

		{#
		ZIP:  {{sbName.ZIP}}<br>
		County:<br>
		Cell Tech:<br>
		Phone Number: <a href="tel:+15555551212">555-555-1212</a><br>
		Email:<br>
		SiteBoss IP:<br>
		Subnet:<br>
		Gateway:<br>
		Router Port:<br>
		Access:<br>
		Notes:<br>
		Power Plant:<br>
		#}
				
		{# #}
		</textarea> 		
	</div>
<button id="dtlBkBtn" class="btn btn-default" onclick="$('.sbcontrols').show();$('#sbdetails').hide();">Back</button>
</div>

<div class="base64Images" style='display:none;' >
    {#
	   This main form is hidden but it is the only form in this page
       which save the image to the database.  Note: hpic is important
       because this gets parse in the siteboss controller to get the id
       of the image model
     #}
	{{ form("siteboss/takephoto/" ~ sbName.UniqueID) }}
	{% for img in myimg %}
	 <input id='hpic{{ img.id }}' name='hpic{{img.id}}'>
	{% endfor %}
	</form>
</div>

<div id='take_photos_div' style='display:none;' >

	<h3>Take Site Photos</h3>
	{# Create another for loop here #}
	{% for key,img in myimg %}
	{{ key + 1}}.  {{img.description}} <br>
	<label class="btn btn-default btn-file">
	Upload <input id='pic{{img.id}}' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
	</label>
	<button class="btn btn-default" data-toggle="modal" data-target="#myModal{{key}}" style='display: none'>View Photo</button>
	<div class="modal" id="myModal{{key}}" role='dialog'>
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">{{img.description}}</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	</div><br>
	{% endfor %}
	<br><br>
	<button id="upBkBtn" class="btn btn-default" onclick="$('.sbcontrols').show();$('#take_photos_div').hide();">Back</button>
</div>


<div class="modal" id="uploadModal" role='dialog'>
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Upload Photos</h4>
		</div>
		<div class="modal-body">
			Press Upload Photos to
			upload photos to the Asentria
			server.  Photos previously
			uploaded will not be re-
			uploaded (unless you took a
			new photo).  Note, this will
			consume phone data.  The
			current amount of photo data
			to be uploaded is 123456K.  If
			this is a problem then wait
			until you are connected via
			wi-fi.  Thanks
			<br>
			<div id="myProgress" align='left'>
			  <div id="myBar"></div>
			</div>		
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
		  <button class="btn btn-default" onclick='submitPhoto();'>Upload Photos</button>
		</div>
	  </div>
	</div>
</div><br>

{# Should we display a modal or not ?
<div id='mes_befor_upload' style='display:none;'>
<textarea disabled rows="12" style="width:20%;">
Press Upload Photos to
upload photos to the Asentria
server.  Photos previously
uploaded will not be re-
uploaded (unless you took a
new photo).  Note, this will
consume phone data.  The
current amount of photo data
to be uploaded is 123456K.  If
this is a problem then wait
until you are connected via
wi-fi.  Thanks
</textarea><br>
<div id="myProgress" align='left'>
  <div id="myBar"></div>
</div>
<button class="btn btn-default" onclick='$("#mes_befor_upload").hide();$(".sbcontrols").show();'> Back</button> 
<button class="btn btn-default" onclick='submitPhoto();'>Upload Photos</button>
</div>
#}




<div class="sbcontrols row">

	<div class="col-md-4">
	</div>

	<div class="col-md-4">

	<button class="btn btn-default" onclick="$('.sbcontrols').hide();$('#sbdetails').show();">See Site Details </button>
	<br>
	<br>
	<button class="btn btn-default" onclick="$('.sbcontrols').hide();$('#sbdetails').hide();$('#take_photos_div').show();">Take Photos</button>
	<br>
	<br>
	{#<button class="btn btn-default" onclick='$("#mes_befor_upload").show();$(".sbcontrols").hide();'> Upload Photos</button>#}
	<button class="btn btn-default" data-toggle="modal" data-target="#uploadModal"> Upload Photos</button>
	
	<br>
	<br>
	<button class="btn btn-default"> Enter Site Notes</button>
	<br>
	<br>
	<button class="btn btn-default"> Mark as Complete</button>
	<br>
	<br>
	<button class="btn btn-default"> Back</button>
	<br>
	<br>
	</div>

	<div class="col-md-4">
	</div>


</div>


{# Move the script to util.js later #}
<script>
	function cacheImage(that)
	{
		 var imgPath = $(that)[0].value;
		 var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		 var modbtn = $(that).parent().next();
		 var image_div = $(modbtn).next();
		 var image_holder = $(image_div).find('div.modal-body');
		 var img = $(image_holder).children();
		 var acceptedExtension = ['gif','png','jpg','jpeg'];

		 if (acceptedExtension.indexOf(extn.toLowerCase())) {
			 if (typeof (FileReader) != "undefined") {
					 image_holder.empty();
					 var reader = new FileReader();
					 reader.onloadend = function (e) {

					var tempImg = new Image();
					tempImg.src = reader.result;
					tempImg.onload = function() {
				 
						var MAX_WIDTH = 1024;
						var MAX_HEIGHT = 576;
						var tempW = tempImg.width;
						var tempH = tempImg.height;
						if (tempW > tempH) {
							if (tempW > MAX_WIDTH) {
							   tempH *= MAX_WIDTH / tempW;
							   tempW = MAX_WIDTH;
							}
						} else {
							if (tempH > MAX_HEIGHT) {
							   tempW *= MAX_HEIGHT / tempH;
							   tempH = MAX_HEIGHT;
							}
						}

						var canvas = document.createElement('canvas');
						canvas.width = tempW;
						canvas.height = tempH;
						var ctx = canvas.getContext("2d");
						ctx.drawImage(this, 0, 0, tempW, tempH);
						var dataURL = canvas.toDataURL("image/" + extn);
						
						 $("<img />", {
							 "src": dataURL,
								 "class": "thumb-image"
						 }).appendTo(image_holder);
					 
					   //Get the hidden input and put this value in
					   var in1 = $('#h' + that.id);
					   in1[0].value = dataURL;
					 }


				 }
				 reader.readAsDataURL($(that)[0].files[0]);
				 $(modbtn).show();


			 } else {
				 alert("This browser does not support FileReader.");
			 }
		 }
		 {#
		   Is there an image show the view button
		   If there is no image hide the view button
		  #}
		 else if(img.length)
		 {
			$(modbtn).show();
		 }
		 else {
			 $(modbtn).hide();
		 }

	}
	
{#

/*
	Show a progress element for any form submission via POST.
	Prevent the form element from being submitted twice.
	*/
	/*
	(function (win, doc) {
		'use strict';
		if (!doc.querySelectorAll || !win.addEventListener) {
			// doesn't cut the mustard.
			return;
		}
		var forms = doc.querySelectorAll('form[method="post"]'),
			formcount = forms.length,
			i,
			submitting = false,
			checkForm = function (ev) {
				if (submitting) {
					ev.preventDefault();
				} else {
					submitting = true;
					this.appendChild(doc.createElement('progress'));
				}
			};
		for (i = 0; i < formcount; i = i + 1) {
			forms[i].addEventListener('submit', checkForm, false);
		}
	}(this, this.document));
	*/
	
	/*
	// grab the form you want to submit.
var formElement = document.getElementById("myFormElement");

// make an xhr object
var request = new XMLHttpRequest();

// track progress
request.upload.addEventListener('progress', progressHandler, false);

// setup request method and url
request.open("POST", formElement.action);

// send the request
request.send(new FormData(formElement));
	
	
	*/
	
#}
	
	
	// progress on transfers from the server to the client (downloads)
function updateProgress (oEvent) {
debugger;
  if (oEvent.lengthComputable) {
    //alert("Some progress");
    var percentComplete = Math.floor(oEvent.loaded/oEvent.total*100);
	var elem = document.getElementById("myBar");   
	elem.style.width = percentComplete + '%'; 
    // ...
  } else {
    // Unable to compute progress information since the total size is unknown
    alert("No progress");
  }
}
	
	
	function submitPhoto()
	{
		debugger;
		var formElement = document.forms[0];
		var oReq = new XMLHttpRequest();
		//oReq.upload.addEventListener("progress", updateProgress(evt));
		oReq.open("POST", formElement.action);
		oReq.upload.onprogress = function(oEvent)
		{
			updateProgress(oEvent);
		}
		oReq.send(new FormData(formElement));
	
	}

</script>
