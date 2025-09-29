 <div class="main-content" id="mainContent">
<div class="">
    <div class="row">
        <?php if (isset($extra)) {
            echo $extra;
        } ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <!-- Grocery CRUD Output -->
                    <?php 
                        if (isset($output)) {
                            echo $output->output; 
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grocery CRUD CSS -->
<?php 
if (isset($output->css_files)) {
    foreach ($output->css_files as $file) {
        echo "<link rel='stylesheet' type='text/css' href='{$file}' />";
    }
}
?>

<!-- Grocery CRUD JS -->
<?php 
if (isset($output->js_files)) {
    foreach ($output->js_files as $file) {
        echo "<script src='{$file}'></script>";
    }
}
?>
</div>


