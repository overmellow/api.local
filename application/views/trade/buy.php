<?php if(validation_errors()){ ?>
    <div class="alert alert-danger">
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<div class="panel panel-success">
    <div class="panel-heading">
        Trade - Buy
    </div>
    <div class="panel-body">
        <?php echo anchor('trade/all/' . $fund_id, '<span class="glyphicon glyphicon-remove pull-right"></span>'); ?> 
        <div class="col-md-8">            
            <?php $hidden = array('fund_id' => $fund_id); 
                echo form_open('trade/buy/' . $fund_id, '', $hidden) ?>
                <div class="input-group">
                    <span class="input-group-addon">Ticket</span>
                    <input type="text" name="ticket" class="form-control" placeholder="Ticket">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Size</span>
                    <input type="text" name="size" class="form-control" placeholder="Size">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Item</span>
                    <input type="text" name="item" class="form-control" placeholder="Item">
                </div>
                <br>                
                <div class="input-group">
                    <span class="input-group-addon">Buy Price</span>
                    <input type="text" name="buy_price" class="form-control" placeholder="Buy Price">
                </div>
                <br>
                <input type="submit" value="Buy" class="btn btn-success" />
            </form>
        </div>
    </div>
</div>