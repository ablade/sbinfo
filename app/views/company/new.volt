
{{ content() }}
<h3>Manage Vendor List </h3>
{{ form("company/create") }}
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
    </fieldset>

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("products", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Save", "class": "btn btn-success") }}
        </li>
    </ul>
    
</form>

Make sure not to create a duplicate code
{% for vc in vCode %}
	{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Code</th>
            <th>Vendor</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ vc.vendor_code |upper}}</td>
            <td>{{ vc.name }}</td>    
		</tr>
	{% if loop.last %}
    </tbody>
</table>
    {% endif %}
{% endfor %}
