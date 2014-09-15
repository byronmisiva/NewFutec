<?php
$this->load->view('headerm');
?>
    <div class="container">
        <!-- Cabecera-->
        <div class="row blanco">
            <div class="col-md-8" id="content">
               <?php
                echo $content;
                ?>
            </div>
            <div class="col-md-4 " id="sidebar">
                <?php
                echo $sidebar;
                ?>
            </div>
        </div>

    </div>
    <!-- /container -->
<?php
$this->load->view('footerm');
?>