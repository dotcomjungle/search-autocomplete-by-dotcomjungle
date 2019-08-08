Dotcomjungle's Autocomplete Search Widget
=========================================
Author: [Dotcomjungle, Inc.](https://www.dotcomjungle.com/)

License: [GPLv3](https://www.gnu.org/licenses/gpl-3.0.html)

Version: 1.0

##### About this plugin
This plugin overrides HTML's (boring and uncustomizable) autofill feature with a
pretty looking and highly functional alternative. It utilizes the basic functionality of
Lea Verou's [Awesomplete](https://leaverou.github.io/awesomplete/), which is extended,
expanded, and optimized for WordPress. Dotcomjungle's Autocomplete Search Widget's features
include:
* Autocomplete that matches anywhere in the text
* Customizable color themes to match your sites themes
* The ability to choose which post types will autofill

##### About [Dotcomjungle](https://www.dotcomjungle.com/)
When we're not contributing to open source, we're building and supporting tech-savvy marketing strategies for growing businesses through consultation and development.

## Plugin Documentation

#### Basic use
Once the plugin is installed and activated, it is very easy to use. Under the admin
tab 'Appearance' > 'Widgets', you will now see Dotcomjungle's Autocomplete Search Widget
as an available widget, which can be dragged in to any widget area you like. It will
appear very much the same as any regular search box your site may already have (if 
it looks a little off, never fear, it can probably be fixed. See the 'Appearance' section 
below). However, when you search in it, a pop-up will appear with suggestions loaded 
from the titles of your sites posts. Selecting one will redirect to that post, 
otherwise searching will behave exactly like a regular search box

### Customizing
To customize the widget's appearance and functionality, head over to 'DCJ Autocomplete 
Search' under the 'Settings' tab of the admin sidebar. If, at any time, you want to reset
settings to their original values, you can select 'Restore Defaults' at the bottom and
it will do just that.

##### Appearance
This section allows you to change the color scheme of the pop-up box to complement your
site's theme, and to not display the search button for the widget. This second option
exists because, on certain themes such as the WordPress Twenty-Twelve theme, certain
styling rules make it so that the search button is awkwardly pushed to the next line. 
To avoid this, the button can be hidden entirely. This feature does not change the 
functionality at all; pressing enter will search just like normal.

##### Functionality
Here, you are able to choose which types of posts the autocomplete pop-up will get the
titles from. This list is programatically generated, so it you add a new post type, such 
as 'Events,' it will appear here. By default only 'Post' and 'Product' (if it exists) are
selected. Below that, two number inputs allow you to customize how and when the autocomplete
box will appear.

##### Advanced
Don't be scared by the 'advanced' title, it's not too complex. It just requires a little
more than selecting a checkbox. Here, you can turn on a feature by which you can turn
all search boxes into Dotcomjungle Autocomplete Search Widgets. This is helpful for some
themes where, if a search returns no results, a larger search-box pops up saying something
along the lines of 'No results, try again.' In order to make this and other search boxes
become DCJ Search Widgets, you can right-click on the desired search box and select the option 
that is something like 'Web Inspector' or 'Inspect element'. It should pop up with a 
window with something enclosed in < > characters highlighted, like the example below:
```html
<input id="example" name="example-name-3" value="example-value"/>
```
In this selection, which is an html input tag, it has various attributes,
in the above example 'id', 'name', and 'value'. You will find the 'name' attribute
and enter its value into the box in the advanced settings tab. If it has any identifying
numbers in it, like the '3' in the above example, replace them with a '#' character, and 
uncheck the box; otherwise leave it checked.

This feature is not failsafe, and depends on your site's theme playing nicely with it. If
autcomplete boxes start to pop up in places like comments or elsewhere, let us know 
(see 'Contact us' below) and we will see if your site's theme is a case that we can fix it for.

## Contact Us

