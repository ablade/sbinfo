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
<div id="sbdetails">
<textarea disabled rows="20" style="width:100%;">
{% for key,value in sbName %}
{{ key }} : {{ value }}&#13;
{% endfor %}
        
</textarea>
		<button class="btn btn-default" onclick="$('.sbcontrols').show();$('#sbdetails').hide();">Back</button>
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
		<button class="btn btn-default"> Take Photos</button>
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

