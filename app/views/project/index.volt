{{ content() }}

{% if role == 'A' %}
{{ form("project/index") }}
<div class="container">
	<div class="row">
           <div id="custom-search-input">
				<div class="input-group col-md-12">
					<input id="proj-search-str" name="proj-search-str" 
					type="text" class="search-query form-control" 
					placeholder="Search"  
					oninput='project.searchProjInfo(this);' />
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit">
							<span class=" glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>
	</div>
</div>
</form>
<br>


<ul class="pager">
    <li class="previous">
        {{ link_to("project", "Go Back") }}
    </li>
    <li class="previous">
        {{ link_to("project/upload", "Upload New Project") }}
    </li>
    <li class="next">
        {{ link_to("project/download", "Download Project") }}
    </li>
    <li class="next">
        {{ link_to("project/new", "Create New Project") }}
    </li>
</ul>
{% endif %}

<h4 style="align-center">Which Project are you supporting?</h4>

<div id="noSelectAlert" class="alert alert-danger">
  You did choose select a project.
</div>
{% for project in myprojects %}
    {% if loop.first %}
<table id="selectionTable" class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Project Name</th>
            {% if role == 'A' %}
			<th>Edit</th>
			<th>Delete</th>
            {% endif %}
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td style="cursor: pointer;" onclick="utilsProject.getSelected(this);" pid="{{project.id}}">
              {{ project.name }}
            </td>
        {% if role == 'A' %}
            <td width="7%">{{ link_to("project/edit/" ~ project.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("project/delete/" ~ project.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        {% endif %}
         </tr>
{% else %}
	<br>
    Try searching for less characters.
{% endfor %}
</table>
<button class="btn" onclick="utilsProject.gotoSelectedId('siteboss','index');">Choose your Project</button>
