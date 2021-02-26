<?php
if ($this->session->flashdata('success_msg')) {
?>
    <div class="alert alert-success no-border">
        <!-- <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button> -->
        <?php echo $this->session->flashdata('success_msg'); ?> </div>
<?php
}
if ($this->session->flashdata('error_msg')) {
?>
    <div class="alert alert-danger no-border">
        <!-- <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button> -->
        <?php echo $this->session->flashdata('error_msg'); ?> </div>
<?php
}
if ($this->session->flashdata('warning_msg')) {
?>
    <div class="alert alert-warning no-border">
        <!-- <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button> -->
        <?php echo $this->session->flashdata('warning_msg'); ?> </div>
<?php
}
if ($this->session->flashdata('deleted_msg')) {
?>
    <div class="alert alert-secondary no-border">
        <!-- <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button> -->
        <?php echo $this->session->flashdata('deleted_msg'); ?> </div>
<?php
}
?>