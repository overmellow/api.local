<div class="panel panel-default">
    <div class="panel-heading">
        Trades        
    </div>
    <div class="panel-body">
        Balance : $<?php echo money_format('%i', $last['balance']); ?>
        <?php echo anchor('trade/buy/' . $fund_id, 'Buy', 'class="btn btn-success btn-xs pull-right"'); ?>
    </div>
    <?php
        $tmpl = array ('table_open' => '<table class="table table-striped">');
        $this->table->set_heading('ID', 'Ticket', 'Buy Time', 'Item', 'Size', 'Buy Price', '');

        $this->table->set_template($tmpl);

        foreach ($trades as $row)
        {            
            $this->table->add_row($row['id'], $row['ticket'], $row['buy_time'], $row['item'], $row['size'], $row['buy_price'], anchor('trade/sell/' . $fund_id . '/' . $row['id'], 'Sell', 'class="btn btn-danger btn-xs"'));            
        }
        echo $this->table->generate();
    ?>
</div>

