<div class="alert alert-danger">
    <?php echo validation_errors(); ?>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        Transfer Money to Fund
    </div>
  <div class="panel-body">
        <a href='#/' class = "pull-right"><span class='glyphicon glyphicon-remove'></span></a>
        <div class="col-md-8">            
            <?php echo form_open('fund_transfer/create') ?>
                <div class="input-group">
                    <span class="input-group-addon">ID</span>
                    <input type="text" name="id" class="form-control" placeholder="ID">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Fund Name</span>
                    <input type="text" name="fund_name" class="form-control" placeholder="Name">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Amount</span>
                    <input type="text" name="amount" class="form-control" placeholder="Amount">
                </div>
                <br>
                <input type="submit" value="Transfer Money to Fund" class="btn btn-success" />
            </form>
        </div>
  </div>
</div>