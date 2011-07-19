## Navigation Module for Bonfire

This is a simple Navigation Module for the Bonfire (http://cibonfire.com/) application.

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

## Helper

The navigation_helper is very simple to use.

		$attributes['id'] = 'nav';
		$attributes['class'] = 'dropdown dropdown-horizontal';
		
		echo show_navigation('header', TRUE, $attributes);

In this case "header" is the Navigation group defined in the Bonfire admin.
"TRUE" tells the helper to display child navigation items.
"$attributes" is an array applied to the main div


- [Log Issues or Suggestions](https://github.com/seandowney/bonfire_navigationmodule/issues)
- [Follow me on Twitter](http://twitter.com/downey_sean)

