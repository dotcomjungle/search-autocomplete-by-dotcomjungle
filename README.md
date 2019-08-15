Search Autocomplete by Dotcomjungle
===================================

Author: [Dotcomjungle, Inc.](https://www.dotcomjungle.com/)

License: [GPLv3 or later](https://www.gnu.org/licenses/gpl-3.0.html)

Version: 1.0

A customizable search widget that autocompletes the titles of products, blog posts, 
events, or anything else you choose.


#### About This Plugin
This plugin overrides standard HTML's (boring and uncustomizable) autofill feature with a
pretty looking and highly functional alternative. It is entirely free, super lightweight,
easy to configure, and looks smooth. 

Search Autocomplete by Dotcomjungle works by creating a search widget that autofills from 
the titles of products, blog posts, events, pages, or anything else you choose. It 
utilizes Lea Verou's excellent [Awesomplete](https://leaverou.github.io/awesomplete/)
to a create smooth, fast, and customizable autofill functionality. Search Autocomplete's 
features include:
* Autocomplete that matches anywhere in the text
* Customizable color themes to match your sites themes
* The ability to choose which post types will autofill

#### About [Dotcomjungle](https://www.dotcomjungle.com/)
Dotcomjungle partners with private and family-owned specialty manufacturers and retailers 
to grow and strengthen their businesses. By partnering with Dotcomjungle's expertise in 
web development, systems integration, constraint elimination and project management, our 
clients support their content savvy marketing departments to increase sales and strengthen 
their businesses for long-term growth.

We look across silos at large slices of your company so we can deliver smart, superior 
web sites, systems and integrations that better help sales people sell, shipping people 
ship, and accounting people keep track. Your CxOs and Marketing Directors will understand 
what is being done, why it is being done and how to measure both our and your successes.

## Plugin Documentation

#### Installation
1. Install the plugin through the WordPress plugin-install screen directly in the site (recommended 
method), or download the latest release of this project from this GitHub and upload the 
uncompressed folder `dcj-autocomplete-search` to the directory `{Site Root}/wp-content/plugins/`
2. Activate 'Search Autocomplete by Dotcomjungle' through the 'Plugins' screen in WordPress
3. Use the 'Settings' > 'Search Autocomplete by Dotcomjungle' screen to configure the plugin
4. Under the 'Appearance' > 'Widgets' admin section, you may use the standard Wordpress widget methods
to name and add the widget to any widget-area on your site

You're all done!

#### Basic Use
Once the plugin is installed and activated, you're ready to insert the basic widget. Under the admin
tab 'Appearance' > 'Widgets', you will now see Search Autocomplete by Dotcomjungle
as an available widget, which can be dragged in to any widget area you like. It will
appear very much the same as any regular search widget your site may already have (it is
in fact able to totally replace your regular search widget with no loss of functionality).
However, when you search in it, a pop-up will appear with suggestions loaded 
from the titles of your sites posts, products, pages, or whatever you select in the settings (see 
[Functionality](#functionality) below). Selecting one of these dropdown options will redirect to that post, 
otherwise searching will behave exactly like a regular search box.

#### Customizing
To customize the widget's appearance and functionality, head over to 'Search Autocomplete 
by Dotcomjungle' under the 'Settings' tab of the admin sidebar. If, at any time, you want to reset
settings to their original values, you can select 'Restore Defaults' at the bottom and
it will do just that.

##### Appearance
This section allows you to change the color scheme of the pop-up box to complement your
site's theme, and to not display the search button for the widget. This second option
exists because, on certain themes such as the WordPress Twenty-Twelve theme, certain
styling rules make it so that the search button is awkwardly pushed to the next line. 
To avoid this, the button can be hidden entirely. This feature does not change the 
functionality at all; pressing enter will search just like normal. In this case it is
recommended to include some placeholder text (something like "Search..." or "Type
something") to indicate the purpose of the box.

##### Functionality
Here, you are able to choose which types of posts the autocomplete pop-up will get the
titles from. This list is programatically generated, so it you add a new post type, such 
as 'Events,' it will appear here. By default only 'Post' and 'Product' (if it exists) are
selected. Below that, two number inputs allow you to customize how and when the autocomplete
box will appear.

##### Advanced
Don't be scared by the 'advanced' title, it's not too complex. It just requires a little
more than selecting a checkbox. Here, you can turn on a feature by which you can turn
all search boxes into Search Autocomplete boxes. This is helpful for some
themes where, if a search returns no results, a larger search-box pops up saying something
along the lines of 'No results, try again.' In order to make this and other search boxes
become Search Autocomplete boxes, you can right-click on the desired search box and select the option 
that is something like 'Web Inspector' or 'Inspect element'. It should pop up with a 
window with something enclosed in < > characters highlighted, like the example below:
```html
<input id="example" name="example-name-3" value="example-value"/>
```
In this selection, called an html input tag, it has various attributes,
in the above example 'id', 'name', and 'value'. You will find the 'name' attribute
and enter its value into the box in the advanced settings tab. If it has any identifying
numbers in it, like the '3' in the above example, replace them with a '#' character, and 
uncheck the box; otherwise leave it checked. In this case you would enter 'example-name-#'.

This feature is not failsafe, and depends on your site's theme playing nicely with it. If
autcomplete boxes start to pop up in places like comments or elsewhere, please file an issue 
with the details described below.

## Improving this Plugin

#### Reporting Bugs
If you're reporting a bug, please do so by filing an issue on this GitHub with these site details:
* WordPress version
* Active theme
* Active plugins
* Your current Search Autocomplete settings
* What you expect to happen
* A screenshot of what is actually happening

Each detail will greatly help the person attempting to resolve the issue and get things 
working as intended!

#### Contributing Code
We welcome contributions and will review each Pull Request that is submitted. To make this 
as quick a process as possible, please do the following for each PR:
* Start by ensuring there's an issue related to the code you're trying to submit. Whether 
this issue is a bug or a feature request, having the issue will help provide context for the code in your PR.
* Only touch files relevant to the issue in your PR. This reduces the time needed to review,
 and helps to prevent merge conflicts.
 
 
 ## Misc.
 > Why are there two files titled 'readme'?
 
 This one, 'README.md' is for github. 'readme.txt' is used by Wordpress when
 the plugin is uploaded to the Wordpress plugin directory. Other than the slight
 formatting differences, they should be kept just about the same.