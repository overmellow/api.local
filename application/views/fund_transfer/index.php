<div class="panel panel-success">
    <div class="panel-heading">
        Funds
        <?php echo anchor('fund/create', 'Add Fund', 'class="btn btn-default btn-xs pull-right"'); ?>
    </div>
    <?php
        $tmpl = array ('table_open' => '<table class="table table-striped">');
        $this->table->set_heading('ID', 'Name', 'Date');

        $this->table->set_template($tmpl);

        foreach ($funds as $row)
        {            
            $this->table->add_row($row['id'], $row['name'], $row['created_at']);            
        }
        echo $this->table->generate();
    ?>
</div>
