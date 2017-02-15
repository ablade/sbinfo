{{ content() }}


{{ form("project/upload", 'enctype' : 'multipart/form-data') }}
    <fieldset>
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div class="form-group row">
                {{ element.label(['class': 'col-md-2 col-form-label', 'align' : 'left']) }}
                  <div class="col-md-10">
					{{ element.render(['class': 'form-control']) }}
                  </div>
            </div>
        {% endif %}
    {% endfor %}
		<div class="form-group row">
			<label class='col-md-2 col-form-label' align ='left' for='spreadsheet'>
			Upload Spreadsheet
			</label>
			<div class="col-md-10">
			<input id='spreadsheet' name='spreadsheet' class='form-control' type='file'>
			</div>
		</div>
    </fieldset>

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("project", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Upload", "class": "btn btn-success") }}
        </li>
    </ul>
    
</form>

{% for pc in pCode %}
	{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>List of Existing Project Codes</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ pc.projectcode |upper}}</td> 
		</tr>
	{% if loop.last %}
    </tbody>
</table>
    {% endif %}
{% endfor %}


