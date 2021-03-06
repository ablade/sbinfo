{{ content() }}

{{ form("project/create") }}

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
            {{ link_to("project", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Save", "class": "btn btn-success") }}
        </li>
    </ul>

</form>
