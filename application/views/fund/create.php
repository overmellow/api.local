<?php echo validation_errors(); ?>

<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            Create Fund
        </div>
        <div class="panel-body">
            <div class="col-md-8"> 
                <?php echo form_open('fund/create') ?>
                    <div class="input-group">
                        <span class="input-group-addon">Name</span>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <br>
                    <input type="submit" value="Create Fund" class="btn btn-success" />
                </form>
            </div>
        </div>
    </div>
</div>