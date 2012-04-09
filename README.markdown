## Navigation Module for Bonfire

This is a simple Navigation Module for the Bonfire (http://cibonfire.com/) application.

All Original Credits go to [Sean Downey](http://twitter.com/downey_sean) for this module.

This version is my personal version, and is still in development.

## Install

- Drop the module into the bonfire/modules folder
- Run the module Install migration
- Add the permissions to the required roles
- Add the helper call to the theme
- That's it

##Features

- Navigation Groups
- Simple Helper to call from the theme template
- Drag-drop Nav item order
- Editable in the Content context inside Bonfire

## Changes
- Added setting to wrap list items in a span for for css styling
- Added setting to change the name of the current active class, defaults to current

## Helper

The navigation_helper is very simple to use.

```php
		<?php
		//Load the helper like below, I load mine in my theme.
		$this->load->helper('navigation/navigation');

		//Setup your ids, classes, etc.  Set Wrap to True if you want span's wrapped around the anchor titles.
		$attributes['id']     = 'nav';
		$attributes['class']  = 'dropdown dropdown-horizontal';

		$attributes['active'] = 'active'; 
		$attributes['wrap']   = true;

		echo show_navigation('header', TRUE, $attributes);
		?>
```
In this case "header" is the Navigation group defined in the Bonfire admin.
"TRUE" tells the helper to display child navigation items.
"$attributes" is an array applied to the main div

## Documentation

Sorry, Eventually, i'll run this through a doxyblocker and make you some docs, for know "Use the Source Luke...."

## Original Author Props

I wanna thank Sean Downey for his work on this Module, and his commitment to Bonfire in General.

- [Log Issues or Suggestions](https://github.com/svizion/bonfire_navigationmodule/issues)
- [Follow me on Twitter](http://twitter.com/svizion)
- [Follow me on Sean Downey on Twitter](http://twitter.com/downey_sean)

