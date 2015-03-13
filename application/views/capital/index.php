<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            Capital Transactions
        </div>
        <?php
            $tmpl = array ('table_open' => '<table class="table table-striped">');
            $this->table->set_heading('ID', 'Reference ID', 'Transaction Type', 'Previous Balance', 'transaction Amount', 'Balance', 'Date');

            $this->table->set_template($tmpl);

            foreach ($transactions as $row)
            {            
                $this->table->add_row($row['id'], $row['reference_id'], $row['transaction_type'], $row['previous_balance'], $row['transaction_amount'],
                        $row['balance'], $row['created_at']);            
            }
            echo $this->table->generate();
        ?>
    </div>
</div>