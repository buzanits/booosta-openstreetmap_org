# Show openstreetmap maps in the Booosta Framework

This modules provides the possibility to show maps from openstreetmap.org in a Booosta web application.

Booosta allows to develop PHP web applications quick. It is mainly designed for small web applications.
It does not provide a strict MVC distinction. Although the MVC concepts influence the framework. Templates,
data objects can be seen as the Vs and Ms of MVC.

Up to version 3 Booosta was available at Sourceforge: https://sourceforge.net/projects/booosta/ From version
4 on it resides on Github and is available from Packagist under booosta/booosta .

## Installation

As this is a module for the Booosta framework, you have to have this framework installed first. See the
[installation instructions](https://github.com/buzanits/booosta-installer) for accomplishing this. If your
Booosta is installed, you can install this module with

```
composer require booosta/openstreetmap_org
```

## Usage

In your scripts you use the module:

```
# [...]
$map = $this->makeInstance('openstreetmap_org', $lat, $lon, $zoom);
$html = $map->get_html();
```

`$lat` and `$lon` are the latitude and longitude of the center of the map. They are in degree. For example
`16.847477`. `$zoom` is the zoom factor of the map. Default is `15`. You also can set the with and height of the map:

```
$map->width($width);
$map->height($height);
```

### Markers

You can place markers on your map. You just have to provide the coordinates of all markers:

```
$markers = [ [$lat1, $lon1], [$lat2, $lon2] ];
$map->set_markers($markers);
$map->add_marker($lat3, $lon3);
```

This will display 3 markers with these coordinates.

You can display the HTML as usual in your templates:

```
# myscript.php
$this->TPL['mymap'] = $map->get_html();

# mytemplate.tpl
{%mymap}
```

