{{ content() }}
<h3 align ="center"> {{ sbName.SiteName }} </h3>
{#<h3 align ="center"> {{ myimg.description }} </h3>#}

{#
<table id="selectionTable" class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
			<th>Attribute</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
#}
<div id="sbdetails" style="display: none;">
<div align="left">


<textarea disabled rows="20" style="width:100%;">

{% for key,value in sbName %}
{{ key }} : {{ value }}&#13;
{% endfor %}
ZIP: {{sbName.ZIP}} &#13;



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
{#
	</tbody>
</table>
#}
<div class="base64Images" style='display:none;' >
{{ form("siteboss/takephoto/" ~ sbName.UniqueID) }}

{# For the length of photo's needed #}
{% for img in myimg %}
 <input id='hpic{{ img.id }}' name='hpic{{img.id}}'>
{% endfor %}
{#
<input id='hpic1' name='hpic1'/>
<input id='hpic2' name='hpic2'/>
<input id='hpic3' name='hpic3'/>
<input id='hpic4' name='hpic4'/>
<input id='hpic5' name='hpic5'/>
<input id='hpic6' name='hpic6'/>
<input id='hpic7' name='hpic7' type='hidden'/>
#}

<input type='submit'/>
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

{#
1.  Before wiring - ATS connections <br>
<label class="btn btn-default btn-file">
Upload <input id='pic1' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal1" style='display: none'>View Photo</button>
<div class="modal" id="myModal1" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br>



2.  Before wiring - Alarm block connections <br>
<label class="btn btn-default btn-file">
Upload <input id='pic2' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal2" style='display: none'>View Photo</button>
<div class="modal" id="myModal2" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br>

3.  Before wiring - Generator controller connections <br>
<label class="btn btn-default btn-file">
Upload <input id='pic3' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal3" style='display: none'>View Photo</button>
<div class="modal" id="myModal3" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br>

4.  Before wiring - Fuel gauge connections <br>
<label class="btn btn-default btn-file">
Upload <input id='pic4' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal4" style='display: none'>View Photo</button>
<div class="modal" id="myModal4" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br>

5.  Front of SiteBoss <br>
<label class="btn btn-default btn-file">
Upload <input id='pic5' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal5" style='display: none'>View Photo</button>
<div class="modal" id="myModal5" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br>

6.  Back of SiteBoss after wired <br>
<label class="btn btn-default btn-file">
Upload <input id='pic6' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal6" style='display: none'>View Photo</button>
<div class="modal" id="myModal6" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br>

7.  Power Connection to fuse panel/power bay <br>
<label class="btn btn-default btn-file">
Upload <input id='pic7' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" data-toggle="modal" data-target="#myModal7" style='display: none'>View Photo</button>
<div class="modal" id="myModal7" role='dialog'>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1.  Before wiring - ATS connections</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><br> 
#}
<br><br>

<button id="upBkBtn" class="btn btn-default" onclick="$('.sbcontrols').show();$('#take_photos_div').hide();">Back</button>
<script>
function cacheImage(that)
{
	//debugger;
	 //See if there's an image
	 //Get count of selected files
     //var countFiles = $(that)[0].files.length;

     var imgPath = $(that)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var modbtn = $(that).parent().next();
     var image_div = $(modbtn).next();
     var image_holder = $(image_div).find('div.modal-body');
     var img = $(image_holder).children();

     
     

     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             //for (var i = 0; i < countFiles; i++) {

				 image_holder.empty();
                 var reader = new FileReader();
                 reader.onloadend = function (e) {
                 
					 ////////////////////////////////////
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
					 debugger;
					   var in1 = $('#h' + that.id);
					   in1[0].value = dataURL;
					 }

                 /*
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
                     }).appendTo(image_holder);
                 */
                 }
                 reader.readAsDataURL($(that)[0].files[0]);
                 $(modbtn).show();
             //}

         } else {
             alert("This browser does not support FileReader.");
         }
     }
     //Is there an image just return
     //If there is no image hide the view button
     else if(img.length)
     {
		//Show button
		$(modbtn).show();
     }
     else {
         $(modbtn).hide();
     }

}
</script>



</div>










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
		<button class="btn btn-default"> Upload Photos</button>
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

