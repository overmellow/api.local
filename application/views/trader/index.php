<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            Traders
        </div>
        <?php
            $tmpl = array ('table_open' => '<table class="table table-striped">');
            $this->table->set_heading('ID', 'Name', 'Email', 'Date');

            $this->table->set_template($tmpl);

            foreach ($traders as $row)
            {            
                $this->table->add_row($row['id'], $row['name'], $row['email'], $row['created_at']);            
            }
            echo $this->table->generate();
        ?>
    </div>
</div>
