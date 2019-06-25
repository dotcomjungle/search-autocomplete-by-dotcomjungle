<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

?>

<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h1 class="wp-heading-inline">Dotcomjungle's Awesomplete-Powered Search Widget</h1>
    <br>
    <br>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <!-- main content -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">
                        <h2><span style="text-decoration: underline">Options</span></h2>

                        <div class="inside">
                            <form name="dcj_awes_options_form" method="post" action="">

                                <h4>Color & Appearance</h4>
                                    <?php
                                        $awes_background = $options['background_color'];
                                        $awes_text = $options['text_color'];
                                    ?>
                                    <input type="hidden" name="dcj_awes_options_submitted" value="yes"/>
                                    <label>Background Color of Autocomplete Box
                                        <select id="background_select" name="background_select">
                                            <option value="white" <?php selected( $awes_background, 'white', TRUE ); ?>>White</option>
                                            <option value="black" <?php selected( $awes_background, 'black', TRUE ); ?>>Black</option>
                                            <option value="lightslategrey" <?php selected( $awes_background, 'lightslategrey', TRUE ); ?>>Grey</option>
                                        </select><br>
                                    </label>
                                    <label>Text Color of Autocomplete
                                        <select id="text_color_select" name="text_color_select">
                                            <option value="white" <?php selected( $awes_text, 'white', TRUE ); ?>>White</option>
                                            <option value="black" <?php selected( $awes_text, 'black', TRUE ); ?>>Black</option>
                                            <option value="lightslategrey" <?php selected( $awes_text, 'lightslategrey', TRUE ); ?>>Grey</option>
                                        </select><br>
                                    </label>

                                <h4>Autocomplete Functionality</h4>
                                    <label>Post Types that will Autofill:
                                        <?php $post_types = $options['post_types'];
                                        foreach ($post_types as $type => $on) { ?>
                                            <div style="text-indent: 18px;">
                                                <input name="<?php echo 'type_'.$type; ?>" type="checkbox" value='true' <?php if ($on == 'true') {echo 'checked';}; ?>/>
                                                <?php echo ucfirst($type); ?><br>
                                            </div>
                                        <?php }; ?>
                                    </label><br>
                                    <label>Max Number of Autofill Pop-Up Results:
                                        <input style="width: 50px" name="max_items" value="<?php echo $options['max_items']; ?>" type="number"/>
                                    </label><br>

                                <input class="button-primary" type="submit" name="dcj_options_submit" value="Save"/>
                                <input class="button-secondary" type="submit" name="dcj_restore_defaults" value="Restore Defaults" />

                            </form>
                        </div>
                        <!-- .inside -->
                    </div>
                    <!-- .postbox -->
                </div>
                <!-- .meta-box-sortables .ui-sortable -->
            </div>
            <!-- post-body-content -->

            <!-- sidebar -->
            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">

                        <h2><span>
                                About Dotcomjungle
                            </span></h2>

                        <div class="inside">
                            <p>
                                words words words
                                description
                            </p>
                        </div>
                        <!-- .inside -->
                    </div>
                    <!-- .postbox -->
                </div>
                <!-- .meta-box-sortables -->
            </div>
            <!-- #postbox-container-1 .postbox-container -->
        </div>
        <!-- #post-body .metabox-holder .columns-2 -->
        <br class="clear">
    </div>
    <!-- #poststuff -->
</div> <!-- .wrap -->