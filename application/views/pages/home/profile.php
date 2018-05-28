<div class="panel with-nav-tabs panel-default">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1default" data-toggle="tab">Profile</a></li>
            <li><a href="#tab2default" data-toggle="tab">Password</a></li>
        </ul>
    </div>
	<?= form_open('/home/profile'); ?>
        <div class="panel-body">                   
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                    <legend>Profile</legend>
                    
                    <div class="form-group">
						<?= form_label('Name :', 'name'); ?>
                        <?= form_input('name', $input->name, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus'])  ?>
						<?= form_error('name') ?>
                    </div>

                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <?= form_input('email', $input->email, ['class' => 'form-control', 'required' => 'required'])  ?>
						<?= form_error('email') ?>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="tab2default">
                    <legend>Update Password</legend>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Input field">
						<?= form_error('password') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
	<?= form_close(); ?>
</div>
