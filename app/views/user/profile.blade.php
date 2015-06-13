@extends("layout")
@section("content")
    <div class="panel panel-default">
        <div class="panel-heading">Party</div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="<?php echo URL::to('/profile/update'); ?>" method="POST" name="userUpdate" id="userUpdate" noValidate>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Edit Account</label>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input required="required" name="username" type="text" value="<?php echo Auth::user()->username; ?>" class="form-control" id="username">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input required="required" name="new_password" type="text" value="" class="form-control" id="new_password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" id="edit_user" class="btn btn-primary pull-right">Update</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <script>
        var forms = document.getElementsByTagName('form');
        for (var i = 0; i < forms.length; i++) {
            forms[i].noValidate = true;

            forms[i].addEventListener('submit', function(event) {
                //Prevent submission if checkValidity on the form returns false.
                if (!event.target.checkValidity()) {
                    event.preventDefault();
                    alert('Please Input All The Field. All Fields Are Mandatory!!');
                    //Implement you own means of displaying error messages to the user here.
                }
            }, false);
        }
    </script>
@stop
