{{ content() }}
<h3 align="center"> {{ project123.name }}
{% if role == 'A' %}
	{% if project123.id %}
		<a href="/project/downloadProject/{{project123.id}}" class="btn btn-primary" title='Download this Project'><i class="glyphicon glyphicon-download-alt"></i></a>
	{% endif %}
{% endif %}
</h3>
<form action="/siteboss/index/{{ project123.id }}" method="post">
<div class="container">
	<div class="row">
           <div id="custom-search-input">
				<div class="input-group col-md-12">
					<input id="site-search-str" name="site-search-str"
					type="text" class="  search-query form-control"
					placeholder="Search" oninput='siteboss.getSitesJSON(this,siteboss.updateSiteNN);'
{% if role == 'A' %}
		role='admin'
{% endif %}
					/>
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

<ul class="pager">
    <li class="previous">
        {{ link_to("project", "&larr; Go Back") }}
    </li>
    {% if role == 'A' %}
    <li class="next">
        {{ link_to("siteboss/new", "Create New SiteBoss") }}
    </li>
    {% endif %}
</ul>


{% for siteboss in sb %}
    {% if loop.first %}
<table id="selectionTable" class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Site Number / Name </th>
       {% if role == 'A' %}
			<th>Edit</th>
			<th>Delete</th>
       {% endif %}
       </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
			<td style="cursor: pointer;" onclick="utilsProject.getSelected(this);" pid="{{siteboss.UniqueID}}">
				{{ siteboss.SiteID }} - {{ siteboss.SiteName }}</td>
			        {% if role == 'A' %}
            <td width="7%">{{ link_to("siteboss/edit/" ~ siteboss.UniqueID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("siteboss/delete/" ~ siteboss.UniqueID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        {% endif %}
        </tr>
    {% if loop.last %}
    </tbody>	
</table>
    {% endif %}
{% else %}
	<br>
    Try searching for less characters.
{% endfor %}

<button class="btn" onclick="utilsProject.gotoSelectedId('siteboss','control');">Edit Selected Site</button>
