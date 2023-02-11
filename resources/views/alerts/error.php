<?php if(isset($error)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?php echo $error?>
            </div>
        </div>
    </div>
<?php endif ?>