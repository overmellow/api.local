<?php echo validation_errors(); ?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Login
        </div>
        <div class="panel-body">
            <div class="col-md-8"> 
                <?php echo form_open('authentication/login') ?>
                    <div class="input-group">
                        <span class="input-group-addon">Email</span>
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon">Password</span>
                        <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                    <br>
                    <input type="submit" value="Login" class="btn btn-success" />
                </form>
            </div>
        </div>
    </div>
</div>