
{{ content() }}

{{ form("user/index") }}
<div class="container">
	<div class="row">
           <div id="custom-search-input">
				<div class="input-group col-md-12">
					<input id="user-search-str" name="user-search-str" type="text" class="  search-query form-control" placeholder="Search" />
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
    </li>

    <li class="next">
        {{ link_to("user/new", "Add User") }}
    </li>
</ul>

{% for user in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
			<th>Email</th>
			<th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ user.name }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.email }}</td>
            <td width="7%">{{ link_to("user/edit/" ~ user.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("user/delete/" ~ user.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
         </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("user/index", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("user/index?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("user/index?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("user/index?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody
</table>
    {% endif %}
{% else %}
	<br>
    Try searching for less characters.
{% endfor %}
