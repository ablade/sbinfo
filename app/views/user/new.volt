
{{ content() }}


<div class="page-header">
    <h2>Add/Edit User for AIR-T</h2>
</div>

{% if is_a(form.getElements()['id'], 'Phalcon\Forms\Element\Hidden') %}
	{{ form('user/save', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
{% else %}
	{{ form('user/new', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
{% endif %}
    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("user", "&larr; Go Back") }}
        </li>
        <li class="pull-right form-actions">
            {{ submit_button('Save', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
        </li>
    </ul>

    <fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
                    
        
        <div class="control-group">
            {{ element.label(['class': 'control-label']) }}
            <div class="controls">
                {{ element.render(['class': 'form-control']) }}
                <p class="help-block">(required)</p>
                <div class="alert alert-warning" id="{{ element.getName() }}_alert">
                    <strong>Warning!</strong> {{ element.blankmessage }}
                </div>
            </div>
        </div>

        {% endif %}
    {% endfor %}

    </fieldset>
</form>

{#


<div class="page-header">
    <h2>Add User for AIR-T</h2>
</div>



{{ form('user/new', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("user", "&larr; Go Back") }}
        </li>
        <li class="pull-right form-actions">
            {{ submit_button('Add User', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
        </li>
    </ul>
    <fieldset>

        <div class="control-group">
            {{ form.label('name', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('name', ['class': 'form-control']) }}
                <p class="help-block">(required)</p>
                <div class="alert alert-warning" id="name_alert">
                    <strong>Warning!</strong> Please enter your full name
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('username', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('username', ['class': 'form-control']) }}
                <p class="help-block">(required)</p>
                <div class="alert alert-warning" id="username_alert">
                    <strong>Warning!</strong> Please enter your desired username
                </div>
            </div>
        </div>
		
        <div class="control-group">
            {{ form.label('reg_role', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('reg_role', ['class': 'form-control']) }}
                <p class="help-block">(required)</p>
                <div class="alert alert-warning" id="reg_role_alert">
                    <strong>Warning!</strong> Please enter your desired user name
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('company_id', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('company_id', ['class': 'form-control']) }}
                <p class="help-block">(required)</p>
                <div class="alert alert-warning" id="company_id_alert">
                    <strong>Warning!</strong> Please select the company this user is for
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('email', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('email', ['class': 'form-control']) }}
                <p class="help-block">(required)</p>
                <div class="alert alert-warning" id="email_alert">
                    <strong>Warning!</strong> Please enter your email
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('password', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('password', ['class': 'form-control']) }}
                <p class="help-block">(minimum 8 characters)</p>
                <div class="alert alert-warning" id="password_alert">
                    <strong>Warning!</strong> Please provide a valid password
                </div>
            </div>
        </div>

        <div class="control-group">
                {{ form.label('password', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('repeatPassword', ['class': 'form-control']) }}
                <div class="alert alert-warning" id="repeatPassword_alert">
                    <strong>Warning!</strong> The password does not match
                </div>
            </div>
        </div>
		<br>

    </fieldset>
</form>

#}
