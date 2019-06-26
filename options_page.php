<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


?>



<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h1 class="wp-heading-inline">Dotcomjungle's Awesomplete-Powered Search Widget</h1><br>
<!--    <br>-->

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <!-- main content -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">
<!--                        <h2><span style="text-decoration: underline">Options</span></h2>-->

                        <div class="inside">
                            <form name="dcj_awes_options_form" method="post" action="">
                                <table>
                                    <tr>
                                        <td><h4>Appearance</h4></td>
                                        <td></td>
                                    </tr>
                                        <?php
                                            $awes_theme = $options['awes_theme_color'];
                                            $awes_highlight = $options['highlight_color'];
                                            $display = $options['display_button'];
                                        ?>
                                        <input type="hidden" name="dcj_awes_options_submitted" value="yes"/>
                                    <tr>
                                        <td>
                                            <label for="awes_theme_color" style="padding: 20px">Color Theme of Autocomplete Box &emsp;</label>
                                        </td>
                                        <td>
                                            <select id="awes_theme_color" name="awes_theme_color">
                                                <option value="light" <?php selected( $awes_theme, 'light', TRUE ); ?>>Light</option>
                                                <option value="dark" <?php selected( $awes_theme, 'dark', TRUE ); ?>>Dark</option>
                                                <option value="grey" <?php selected( $awes_theme, 'grey', TRUE ); ?>>Grey</option>
                                            </select><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="display_button" style="padding: 20px">Display 'Search' Button</label>
                                        </td>
                                        <td>
                                            <input id="display_button" name="display_button" type="checkbox" value="true" <?php if ($display == 'true') {echo 'checked';}; ?>/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><h4>Autocomplete Functionality</h4></td>
                                    </tr>
                                        <td>
                                            <label style="padding: 20px">Post Types that will Autofill:</label>
                                        </td>
                                        <?php $post_types = $options['post_types'];
                                        ksort($post_types);
                                        $first_item = true;
                                        foreach ($post_types as $type => $on) { ?>
                                                <tr>
                                                    <td style="text-indent: 40px; padding: 1px">
                                                        <input name="<?php echo 'type_'.$type; ?>" type="checkbox" value="true" <?php if ($on == 'true') {echo 'checked';}; ?>/>
                                                        <?php echo ucfirst($type); ?>
                                                    </td>
                                                </tr>
                                        <?php }; ?>
                                    <tr>
                                        <td>
                                            <label for="max_items" style="padding: 20px">Maximum Number of Autofill Pop-Up Results:</label>
                                        </td>
                                        <td>
                                            <input style="width: 50px" id="max_items" name="max_items" min=1 value="<?php echo $options['max_items']; ?>" type="number"/>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="min_chars" style="padding: 20px">Minimum Characters to Initiate Pop-Up:</label>
                                        </td>
                                        <td>
                                            <input style="width: 50px; left: 30px;" id="min_chars" name="min_chars" min=1 value="<?php echo $options['min_chars']; ?>" type="number"/>
                                        </td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <td>
                                            <input class="button-primary" type="submit" name="dcj_options_submit" value="Save"/>
                                            <input class="button-secondary" type="submit" name="dcj_restore_defaults" value="Restore Defaults" />
                                        </td>
                                    </tr>
                                </table>
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