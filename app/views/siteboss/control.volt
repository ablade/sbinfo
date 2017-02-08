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

{#
<textarea disabled rows="20" style="width:100%;">

{% for key,value in sbName %}
{{ key }} : {{ value }}&#13;
{% endfor %}
ZIP: {{sbName.ZIP}} &#13;


#}

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

        
{# </textarea> #}
		
</div>
<button id="dtlBkBtn" class="btn btn-default" onclick="$('.sbcontrols').show();$('#sbdetails').hide();">Back</button>
</div>
{#
	</tbody>
</table>
#}












	<div class="sbcontrols row">

		<div class="col-md-4">
		</div>

		<div class="col-md-4">

		<button class="btn btn-default" onclick="$('.sbcontrols').hide();$('#sbdetails').show();">See Site Details </button>
		<br>
		<br>
		<button class="btn btn-default" onclick='window.location="/siteboss/takephoto/{{sbName.id}}"'> Take Photos</button>
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

