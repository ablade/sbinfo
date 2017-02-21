{{ content() }}
<h3 align ="center"> {{ sbName.SiteName }} </h3>

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

<div id='take_photos_div' style='display:none;' >

<h3>Take Site Photos</h3>

1.  Before wiring - ATS connections <br>
<label class="btn btn-default btn-file">
Upload <input id='alvin' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button>
<div style='display:none;'></div><br>

2.  Before wiring - Alarm block connections <br>
<label class="btn btn-default btn-file">
Upload <input type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button>
<div style='display:none;'></div><br>

3.  Before wiring - Generator controller connections <br>
<label class="btn btn-default btn-file">
Upload <input type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button>
<div style='display:none;'></div><br>

4.  Before wiring - Fuel gauge connections <br>
<label class="btn btn-default btn-file">
Upload <input type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button> 
<div style='display:none;'></div><br>

5.  Front of SiteBoss <br>
<label class="btn btn-default btn-file">
Upload <input type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button> 
<div style='display:none;'></div><br>

6.  Back of SiteBoss after wired <br>
<label class="btn btn-default btn-file">
Upload <input type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button> 
<div style='display:none;'></div><br>

7.  Power Connection to fuse panel/power bay <br>
<label class="btn btn-default btn-file">
Upload <input type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button class="btn btn-default" onclick="$(this).next().toggle();">View Photo</button>
<div style='display:none;'></div> <br><br>

<button id="upBkBtn" class="btn btn-default" onclick="$('.sbcontrols').show();$('#take_photos_div').hide();">Back</button>
<script>
function cacheImage(that)
{
	debugger;
	     //Get count of selected files
     var countFiles = $(that)[0].files.length;

     var imgPath = $(that)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $(that).parent().next().next();
     image_holder.empty();

     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {

                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
                     }).appendTo(image_holder);
                 }

                 //image_holder.show();
                 reader.readAsDataURL($(that)[0].files[i]);
             }

         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
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

