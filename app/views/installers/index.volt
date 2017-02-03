{{ content() }}

{% if psearch %}
<div class="container">
	<div class="row">
           <div id="custom-search-input">
				<div class="input-group col-md-12">
					<input type="text" class="  search-query form-control" placeholder="Search" />
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button">
							<span class=" glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>
	</div>
</div>
{% endif %}

		<h2>Choose a project</h2>
{% for project in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Project ID</th>
            <th>Project Name</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr style="cursor: pointer;" onclick="location.pathname ='/air/projects/siteslist/{{project.id}}';">
            <td>{{ project.project_id }}</td>
            <td>{{ project.name }}</td>
         </tr>
    {% if loop.last %}
    </tbody>
	{#
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("products/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("products/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("products/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("products/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody
	#}
</table>
    {% endif %}
{% else %}
    No projects were found for you
{% endfor %}


