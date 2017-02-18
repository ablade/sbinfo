{{ content() }}


<div class="container">
	<div class="row">
           <div id="custom-search-input">
				<div class="input-group col-md-12">
					<input id="proj-search-str" name="proj-search-str" 
					type="text" class="search-query form-control" 
					placeholder= "Search"  
					oninput='project.getProjectJSON(this,project.updateProjDownload);' />
				</div>
			</div>
	</div>
</div>

<br>
{% for pc in myprojects %}
	{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Project Code</th>
            <th>Project Name</th>
            <th>Download XLSX</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ pc.projectcode |upper}}</td>
            <td>{{ pc.name}}</td>  
             <td width="7%">{{ link_to("project/downloadProject/" ~ pc.id, '<i class="glyphicon glyphicon-download-alt"></i> Download'
             , "class": "btn btn-default") }}</td>

		</tr>
	{% if loop.last %}
    </tbody>
</table>
    {% endif %}
{% endfor %}


