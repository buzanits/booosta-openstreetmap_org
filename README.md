# Show openstreetmap maps in the Booosta Framework or PHP scripts

This modules provides the possibility to show maps from openstreetmap.org in a Booosta web application.
It can also be used standalone without the Booosta framework.

Booosta allows to develop PHP web applications quick. It is mainly designed for small web applications.
It does not provide a strict MVC distinction. Although the MVC concepts influence the framework. Templates,
data objects can be seen as the Vs and Ms of MVC.

Up to version 3 Booosta was available at Sourceforge: https://sourceforge.net/projects/booosta/ From version
4 on it resides on Github and is available from Packagist under booosta/booosta .

## Installation

This module can be used inside the Booosta framework. If you want to do so, install the framework first. See the
[installation instructions](https://github.com/buzanits/booosta-installer) for accomplishing this. If your
Booosta is installed, you can install this module.

You also can use this module in your standalone PHP scripts. In both cases you install it with:

```
composer require booosta/openstreetmap_org
```

## Usage in the Booosta framework

In your scripts you use the module:

```
# [...]
$map = $this->makeInstance('openstreetmap_org', $lat, $lon, $zoom);
$html = $map->get_html();
```

## Usage in standalone PHP scripts

In your PHP script you use:

```
<?php
require_once __DIR__ . '/vendor/autoload.php';

use \booosta\openstreetmap_org\Openstreetmap_org as OSM;

$map = new OSM($lat, $lon, $zoom);
print $map->loadHTML();
```

`$lat` and `$lon` are the latitude and longitude of the center of the map. They are in degree. For example
`16.847477`. `$zoom` is the zoom factor of the map. Default is `15`. You also can set the with and height of the map
(before calling `get_html()` or `loadHTML()`):

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

You can display the HTML as usual in your Booosta templates:

```
# myscript.php
$this->TPL['mymap'] = $map->get_html();

# mytemplate.tpl
{%mymap}
```

