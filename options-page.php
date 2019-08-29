<?php defined( 'ABSPATH' ) or die( 'Direct access to this file is not permitted' );

global $dcj_awesomplete_plugin_url;
?>


<style>
    .indent-pad {
        padding-left: 20px;
        margin: 0;
    }

    .wrap .postbox td {
        font-size: 13px;
    }
</style>


<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h1 class="wp-heading-inline">Search Autocomplete by Dotcomjungle</h1><br>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2" style="width: 100%">
            <!-- main content -->
            <div id="post-body-content" style="width: 62%">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">
                        <h2>
                            About This Plugin
                        </h2>
                        <div class="inside">
                            <p>
                                Search Autocomplete is an extension and widget overrides Wordpress' standard autofill
                                feature with a nicer looking and more functional alternative. It creates a search
                                widget that autofills from the titles of products, blog posts, events,
                                pages, or anything else you choose.
                            </p>
                            <em>For information and help
                                <a href="https://www.dotcomjungle.com/search-autocomplete-extension-for-wordpress/"
                                   target="_blank" rel="noreferrer noopener">visit the documentation</a>
                            </em>
                        </div>
                    </div>
                    <div class="postbox">

                        <h2>Settings</h2>

                        <div class="inside">
                            <form name="dcj_awes_options_form" method="post" action="">
                                <table>
                                    <tr>
                                        <td>
                                            <h4 style="margin-top: 0">Appearance</h4>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name="dcj_awes_options_submitted" value="yes"/>
                                <table>
									<?php
									$awes_theme     = $options['awes_theme_color'];
									$awes_highlight = $options['highlight_color'];
									$display        = $options['display_button'];
									$placeholder    = $options['placeholder'];
									$max_height     = $options['max_height'];
									?>
                                    <tr>
                                        <td>
                                            <label for="awes_theme_color" class="indent-pad">Color Theme of Autocomplete
                                                Box &emsp;</label>
                                        </td>
                                        <td>
                                            <select id="awes_theme_color" name="awes_theme_color">
                                                <option value="light" <?php selected( $awes_theme, 'light', true ); ?>>
                                                    Light
                                                </option>
                                                <option value="grey" <?php selected( $awes_theme, 'grey', true ); ?>>
                                                    Grey
                                                </option>
                                                <option value="dark" <?php selected( $awes_theme, 'dark', true ); ?>>
                                                    Dark
                                                </option>
                                            </select><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="placeholder_text" class="indent-pad">
                                                Placeholder Text
                                            </label>
                                        </td>
                                        <td>
                                            <input id="placeholder_text" name="placeholder_text" type="text"
                                                   value="<?php echo $placeholder; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="indent-pad" for="max_height">Max Height of the Autocomplete
                                                Pop-Up</label>
                                        </td>
                                        <td>
                                            <input type="number" name="max_height" id="max_height" min="0" step="1"
                                                   style="max-width: 70px" value="<?php echo $max_height; ?>"/>
                                            Pixels
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="display_button" class="indent-pad">Display 'Search'
                                                Button</label>
                                        </td>
                                        <td>
                                            <input id="display_button" name="display_button" type="checkbox"
                                                   value="yes" <?php if ( $display == 'yes' ) {
												echo 'checked';
											}; ?>/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><h4>Autocomplete Functionality</h4></td>
                                    </tr>
                                    <td>
                                        <label class="indent-pad">Post Types that will Autofill:</label>
                                    </td>
									<?php $post_types = $options['post_types'];
									ksort( $post_types );
									foreach ( $post_types as $type => $on ) { ?>
                                        <tr>
                                            <td style="text-indent: 40px; padding: 1px">
                                                <input id="<?php echo 'type_' . $type; ?>"
                                                       name="<?php echo 'type_' . $type; ?>" type="checkbox"
                                                       value="yes" <?php if ( $on == 'yes' ) {
													echo 'checked';
												}; ?>/>
                                                <label for="<?php echo 'type_' . $type; ?>"><?php echo ucfirst( $type ); ?></label>
                                            </td>
                                        </tr>
									<?php }; ?>
                                    <tr>
                                        <td><span style="line-height: 2px">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="max_items" class="indent-pad">Maximum Number of Autofill Pop-Up
                                                Results:&nbsp;&nbsp;</label>
                                        </td>
                                        <td>
                                            <input style="width: 50px" id="max_items" name="max_items" min=1
                                                   value="<?php echo $options['max_items']; ?>" type="number"/>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="min_chars" class="indent-pad">Minimum Characters to Initiate
                                                Pop-Up:</label>
                                        </td>
                                        <td>
                                            <input style="width: 50px; left: 30px;" id="min_chars" name="min_chars"
                                                   min=1 value="<?php echo $options['min_chars']; ?>" type="number"/>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>
                                            <h4>Advanced</h4>
                                        </td>
                                        <td>
											<?php $show_advanced = esc_attr( $_POST['show_advanced'] ); ?>
                                            <input type="hidden" id="show_advanced" name="show_advanced"
                                                   value="<?php echo $show_advanced; ?>"/>

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
                                                <label class="indent-pad" style="text-decoration: underline">Make All
                                                    Search Boxes Autocomplete</label>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
												<?php
												$input_name = $options['input_name'];
												$full_name  = $options['full_name'];
												?>
                                                <label class="indent-pad" for="input_name_select_1">Input Name: </label>
                                                <input type="text" id="input_name_select_1" name="input_name_select_1"
                                                       autocomplete="off" value="<?php echo $input_name; ?>"/>
                                                &nbsp;
                                                <input type="checkbox" id="full_name" name="full_name"
                                                       value="yes" <?php if ( $full_name == 'yes' ) {
													echo 'checked';
												}; ?>/>
                                                <label for="full_name">There is no identifying number</label>
                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td style="max-width: 445px">
                                                <p class="indent-pad">
                                                    &emsp; Enter the CSS 'name' attribute of your theme's search inputs.
                                                    If there is a unique identifying number at the end of the name,
                                                    add a '#' in its place, and uncheck the box. This name can be
                                                    found on most browsers by right-clicking on the input box and
                                                    selecting 'inspect element'. Practicing on the above input, for
                                                    example, you would get a name of "input_name_select_#".
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><br></td>
                                        </tr>
                                    </table>
                                </div> <!-- advanced settings end -->

                                <table>
                                    <tr>
                                        <td>
                                            <input class="button-primary" type="submit" name="dcj_options_submit"
                                                   value="Save"/>
                                            <input class="button-secondary" type="submit" name="dcj_restore_defaults"
                                                   value="Restore Defaults"/>
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
            <div id="postbox-container-1" class="postbox-container" style="width: 36%; margin-right: 0">
                <div class="meta-box-sortables">
                    <div class="postbox">

                        <h2>About Dotcomjungle</h2>

                        <div class="inside">
                            <p>
                                <a href="https://www.dotcomjungle.com/" target="_blank" rel="noreferrer noopener">
                                    Dotcomjungle</a> partners with private and family-owned specialty manufacturers and
                                retailers to grow and strengthen their businesses. By partnering with Dotcomjungle's
                                expertise in web development, systems integration, constraint elimination and project
                                management, our clients support their content savvy marketing departments to increase
                                sales and strengthen their businesses for long-term growth.<br><br>
                                We look across silos at large slices of your company so we can deliver smart, superior
                                web sites, systems and integrations that better help sales people sell, shipping
                                people ship, and accounting people keep track. Your CxOs and Marketing Directors
                                will understand what is being done, why it is being done and how to measure both our
                                and your successes.<br><br>
                                Sometimes our work leads us to build customized extensions for our client partners,
                                which we love to share with the open source community, like this!
                            </p>
                            <p>
                                Learn more about us and what we can do for you and your business
                                <a href="https://www.dotcomjungle.com/" target="_blank" rel="noreferrer noopener">
                                here</a>!
                            </p>
                        </div>
                        <!-- .inside -->
                    </div>

                    <div class="postbox">

                        <h2>About Awesomplete</h2>

                        <div class="inside">
                            <p>
                                Dotcomjungle's Autocomplete Search Widget is powered by Lea Verou's
                                <a href="https://leaverou.github.io/awesomplete/" target="_blank"
                                   rel="noreferrer noopener">Awesomplete</a>,
                                a simple yet high-powered javascript library. Awesomplete is distributed under
                                the <a href="https://github.com/LeaVerou/awesomplete/blob/gh-pages/LICENSE"
                                       target="_blank" rel="noreferrer noopener">MIT
                                    License</a>.
                            </p>
                        </div>
                        <!-- .inside -->
                    </div>
                    <!-- .postbox -->

                    <div class="postbox">
                        <div class="inside">
                            <h4>Reporting Bugs</h4>
                            <p>
                                If you find a bug,
                                <a href="https://github.com/dotcomjungle/search-autocomplete-by-dotcomjungle/issues"
                                   target="_blank" rel="noreferrer noopener">file an issue</a>
                                and we will address it soon. Please include the following info when reporting a bug,
                                in order to help us better address the problem:
                            </p>
                            <ul class="indent-pad" style="list-style-type:disc;">
                                <li>WordPress version</li>
                                <li>Active theme</li>
                                <li>Active plugins</li>
                                <li>Your current Search Autocomplete settings</li>
                                <li>What you expect to happen</li>
                                <li>A screen-shot of what is actually happening</li>
                            </ul>
                            <h4>Contributing, Modifying, and Sharing</h4>
                            <p>
                                This plugin is distributed under the <a href="https://www.gnu.org/licenses/gpl-3.0.html"
                                                                        target="_blank" rel="noreferrer noopener">
                                    GPLv3</a> license, meaning it is free to use, share, or modify
                                however you want! That said, we would love if you give us some credit if you use
                                our work, just as we have done with Awesomplete.
                                <br><br>
                                If you want to contribute to this project, visit our
                                <a href="https://github.com/dotcomjungle/search-autocomplete-by-dotcomjungle#contributing-code"
                                   target="_blank" rel="noreferrer noopener">GitHub</a>.
                            </p>
                        </div>
                    </div>

                </div>
                <!-- .meta-box-sortables -->
            </div>
            <!-- #postbox-container-1 .postbox-container -->
        </div>
        <!--         #post-body .metabox-holder .columns-2 -->
        <br class="clear">
    </div>
    <!-- #poststuff -->
</div> <!-- .wrap -->

