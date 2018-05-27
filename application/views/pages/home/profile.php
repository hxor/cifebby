<div class="panel with-nav-tabs panel-default">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1default" data-toggle="tab">Profile</a></li>
            <li><a href="#tab2default" data-toggle="tab">Password</a></li>
        </ul>
    </div>
    <form action="" method="POST" role="form">
        <div class="panel-body">                   
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                    <legend>Profile</legend>
                    
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Input field">
                    </div>

                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Input field">
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="tab2default">
                    <legend>Update Password</legend>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Input field">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>