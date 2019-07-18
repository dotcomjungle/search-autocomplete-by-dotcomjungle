<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>


<style>
    .indent-pad {
        padding-left: 20px;
        margin: 0;
    }
</style>

<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h1 class="wp-heading-inline">Dotcomjungle's Autocomplete Search Widget</h1><br>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <!-- main content -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">
                    <!-- <h2><span style="text-decoration: underline">Options</span></h2>-->
                        <h4 style="padding-left: 12px">Appearance</h4>

                        <div class="inside">
                            <form name="dcj_awes_options_form" method="post" action="">
                                <table>
                                    <?php
                                        $awes_theme = $options['awes_theme_color'];
                                        $awes_highlight = $options['highlight_color'];
                                        $display = $options['display_button'];
                                    ?>
                                    <input type="hidden" name="dcj_awes_options_submitted" value="yes"/>
                                    <tr>
                                        <td>
                                            <label for="awes_theme_color" class="indent-pad">Color Theme of Autocomplete Box &emsp;</label>
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
                                            <label for="display_button" class="indent-pad">Display 'Search' Button</label>
                                        </td>
                                        <td>
                                            <input id="display_button" name="display_button" type="checkbox" value="true" <?php if ($display == 'true') {echo 'checked';}; ?>/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><h4>Autocomplete Functionality</h4></td>
                                    </tr>
                                        <td>
                                            <label class="indent-pad">Post Types that will Autofill:</label>
                                        </td>
                                        <?php $post_types = $options['post_types'];
                                        ksort($post_types);
                                        foreach ($post_types as $type => $on) { ?>
                                                <tr>
                                                    <td style="text-indent: 40px; padding: 1px">
                                                        <input id="<?php echo 'type_'.$type; ?>" name="<?php echo 'type_'.$type; ?>" type="checkbox" value="true" <?php if ($on == 'true') {echo 'checked';}; ?>/>
                                                        <label for="<?php echo 'type_'.$type; ?>"><?php echo ucfirst($type); ?></label>
                                                    </td>
                                                </tr>
                                        <?php }; ?>
                                    <tr><td><span style="line-height: 2px">&nbsp;</span></td></tr>
                                    <tr>
                                        <td>
                                            <label for="max_items" class="indent-pad">Maximum Number of Autofill Pop-Up Results:&nbsp;&nbsp;</label>
                                        </td>
                                        <td>
                                            <input style="width: 50px" id="max_items" name="max_items" min=1 value="<?php echo $options['max_items']; ?>" type="number"/>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="min_chars" class="indent-pad">Minimum Characters to Initiate Pop-Up:</label>
                                        </td>
                                        <td>
                                            <input style="width: 50px; left: 30px;" id="min_chars" name="min_chars" min=1 value="<?php echo $options['min_chars']; ?>" type="number"/>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>
                                            <h4>Advanced</h4>
                                        </td>
                                        <td>
                                            <?php $show_advanced = esc_attr($_POST['show_advanced']); ?>
                                            <input type="hidden" id="show_advanced" name="show_advanced" value="<?php echo $show_advanced; ?>"/>

                                            <a onclick="
                                                document.getElementById('dcj_advanced_settings').style.display = 'block';
                                                document.getElementById('hide_button').style.display = 'block';
                                                document.getElementById('show_button').style.display = 'none';
                                                document.getElementById('show_advanced').value = 'yes';
                                            "><em id="show_button" style="display: block;">&nbsp;show</em></a>

                                            <a onclick="
                                                document.getElementById('dcj_advanced_settings').style.display = 'none';
                                                document.getElementById('hide_button').style.display = 'none';
                                                document.getElementById('show_button').style.display = 'block';
                                                document.getElementById('show_advanced').value = 'no';
                                            "><em id="hide_button" style="display: none;">&nbsp;hide</em></a>

                                        </td>
                                    </tr>
                                </table>

                                <div id="dcj_advanced_settings" style="display: none;">
                                <table>
                                    <tr>
                                        <td>
                                            <label class="indent-pad" style="text-decoration: underline">Make All Search Boxes into DCJ Autocomplete Widgets</label>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                                $input_name = $options['input_name'];
                                                $full_name = $options['full_name'];
                                            ?>
                                            <label class="indent-pad" for="input_name_select_1">Input Name: </label>
                                            <input type="text" id="input_name_select_1" name="input_name_select_1" autocomplete="off" value="<?php echo $input_name; ?>"/>
                                            &nbsp;
                                            <input type="checkbox" id="full_name" name="full_name" value="true" <?php if ($full_name == 'true') {echo 'checked';}; ?>/>
                                            <label for="full_name">There is no identifying number</label>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td style="max-width: 445px">
                                            <p class="indent-pad">
                                                &emsp; Enter the CSS 'name' attribute of your theme's search inputs. If
                                                there is a unique identifying number at the end of the name, add a '#'
                                                in its place, and uncheck the box. This name can be found on most
                                                browsers by right-clicking on the input box and selecting 'inspect
                                                element'. Practicing on the above input, for example, you would get
                                                a name of "input_name_select_#".
                                            </p>
                                        </td>
                                    </tr>

                                    <tr><td><br></td></tr>
                                </table>
                                </div> <!-- advanced settings end -->

                                <table>
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

                        <h2>About Dotcomjungle</h2>

                        <div class="inside">
                            <p>
                                words words words
                                description
                            </p>
                            <p>
                                Learn more about us and what we can do for you and your Wordpress site
                                <a href="https://www.dotcomjungle.com/wordpress-woocommerce-web-development/">
                                here</a>!
                            </p>
                            <p>
                                If you find a bug, or have a suggestion or comment, you may contact the developer
                                <a href="mailto:julianrice@dotcomjungle.com?subject=[DCJ%20Search%20Plugin%20]">
                                here</a>.
                            </p>
                        </div>
                        <!-- .inside -->
                    </div>
                    <!-- .postbox -->

                    <div class="postbox">

                        <h2><span>
                                About Awesomplete
                            </span></h2>

                        <div class="inside">
                            <p>
                                Dotcomjungle's Autocomplete Search Widget is powered by Lea Verou's
                                <a href="https://leaverou.github.io/awesomplete/">Awesomplete</a>,
                                a simple yet high-powered javascript library. Awesomplete is distributed under
                                the <a href="https://github.com/LeaVerou/awesomplete/blob/gh-pages/LICENSE">MIT
                                License</a>.
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

