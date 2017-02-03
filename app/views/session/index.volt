
{{ content() }}

<div class="row">
	<div class="col-md-4">
	
	</div>
    <div class="col-md-4">
        <div class="page-header">
            <h2 align="center">Log In</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">Your Name</label>
                    <div class="controls">
                        {{ text_field('inst_name', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Username/Email</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>
	
	<div class="col-md-4">
	
	</div>
</div>
