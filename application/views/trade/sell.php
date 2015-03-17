<?php if(validation_errors()){ ?>
    <div class="alert alert-danger">
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<div class="panel panel-danger">
    <div class="panel-heading">
        Trade - Sell
    </div>
    <div class="panel-body">
        <?php echo anchor('trade/all/' . $fund_id, '<span class="glyphicon glyphicon-remove pull-right"></span>'); ?> 
        <div class="col-md-8">            
            <?php $hidden = array('fund_transfer_id' => $trade['fund_transfer_id'], 'id' => $trade['id']);
                echo form_open('trade/sell/' . $trade['id'] . '/' . $fund_id, '', $hidden) ?>
                <div class="input-group">
                    <span class="input-group-addon">ID</span>
                    <input type="text" name="id" class="form-control" placeholder="Id" disabled="True" value="<?php echo $trade['id']; ?>">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Ticket</span>
                    <input type="text" name="ticket" class="form-control" placeholder="Ticket" disabled="True" value="<?php echo $trade['ticket']; ?>">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Size</span>
                    <input type="text" name="size" class="form-control" placeholder="Size" disabled="True" value="<?php echo $trade['size']; ?>">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Item</span>
                    <input type="text" name="item" class="form-control" placeholder="Item" disabled="True" value="<?php echo $trade['item']; ?>">
                </div>
                <br>                
                <div class="input-group">
                    <span class="input-group-addon">Buy Price</span>
                    <input type="text" name="buy_price" class="form-control" placeholder="Buy Price" disabled="True" value="<?php echo $trade['buy_price']; ?>">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Size</span>
                    <input type="text" name="size" class="form-control" placeholder="Size" value="<?php echo $trade['size']; ?>">
                </div>
                <br>                
                <div class="input-group">
                    <span class="input-group-addon">Sell Price</span>
                    <input type="text" name="sell_price" class="form-control" placeholder="Sell Price" value="<?php echo $trade['buy_price']; ?>">
                </div>
                <br>                
                <input type="submit" value="Sell" class="btn btn-danger" />
            </form>
        </div>
    </div>
</div>