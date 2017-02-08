{{ content() }}
<h3 align="center"> {{ project123.name }}</h3>
<form action="/siteboss/index/{{ project123.id }}" method="post">
<div class="container">
	<div class="row">
           <div id="custom-search-input">
				<div class="input-group col-md-12">
					<input id="site-search-str" name="site-search-str" type="text" class="  search-query form-control" placeholder="Search" />
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


{% for siteboss in page.items %}
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
			<td style="cursor: pointer;" onclick="utilsProject.getSelected(this);" pid="{{siteboss.id}}">
				{{ siteboss.ProjectCode }} - {{ siteboss.SiteName }}</td>
			        {% if role == 'A' %}
            <td width="7%">{{ link_to("siteboss/edit/" ~ siteboss.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("siteboss/delete/" ~ siteboss.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        {% endif %}
        </tr>
    {% if loop.last %}
    </tbody>
	{#
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("siteboss/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("siteboss/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("siteboss/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("siteboss/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody
	#}
</table>
    {% endif %}
{% else %}
	<br>
    Try searching for less characters.
{% endfor %}

<button class="btn" onclick="utilsProject.gotoSelectedId('siteboss','control');">Edit Selected Site</button>
