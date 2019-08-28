<!-- for naming widget in admin backend -->

<?php defined( 'ABSPATH' ) or die( 'Direct access to this file is not permitted' ); ?>

<body>
<p>
    <label>Title</label>
    <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
           value="<?php echo $title; ?>"/>
</p>
<body>