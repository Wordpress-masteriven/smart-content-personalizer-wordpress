=== Plugin Name ===
Contributors: Smart Content Personalizer
Tags: smart, cntent, personalizer
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==
Smart Content Personalizer
Allows website content editors to display content in different areas of the site based on various conditions:

1.Displaying content based on user permissions: new guest, registered user, returning user.
2.Displaying content based on location.
3.Displaying content based on time: content that appears at a specific hour, content created within a specific time frame, content created on a specific day and time.
4.Displaying content when a customer abandons their cart.

The editor is based on TinyMCE. Putting simple text and design it, Uploading and adding media to the editor,Editing with html code. 

The shortcodes for user permissions:
new guest -  [newGuestContentShortcode]
registered user -  [returnUserContentShortcode]
returning user -  [LocalUserContentShortcode]

The shortcodes for user location:
Local users -  [LocalUserContentShortcode]
Worldwide users -  [WorldwideUserContentShortcode]

The shortcodes for content based on time:
Content in specific time (Hour) every day - [SpecificTimeContentShortcode] 
Content in between times every day - [betweenTimesContentShortcode]
Content in specific day in specific time (Hour) - [specificDayTimeContentShortcode]

The shortcodes for content based on abandoned cart: [abandonedCartContentTimeContentShortcode]

== Installation ==
1.Download the Plugin:

Download the plugin ZIP file from the WordPress Plugin Directory or another source.

2.Upload the Plugin:

Go to the WordPress admin dashboard.
Navigate to Plugins > Add New.
Click the Upload Plugin button at the top.
Choose the downloaded ZIP file and click Install Now.

3.Activate the Plugin:

Once the installation is complete, click Activate Plugin.