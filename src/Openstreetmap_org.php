<?php
namespace booosta\openstreetmap_org;

use \booosta\Framework as b;
b::init_module('openstreetmap_org');

class Openstreetmap_org extends \booosta\base\Module
{
  use moduletrait_openstreetmap_org;

  protected $id = 'osm1';
  protected $lon, $lat, $zoom;
  protected $width = '100%', $height = '100%';
  protected $marker = [];


  public function __construct($lat, $lon, $zoom = 15, $id = null)
  {
    $this->lon = $lon;
    $this->lat = $lat;
    $this->zoom = $zoom;
    if($id) $this->id = $id;
  }

  public function zoom($val) { $this->zoom = $val; }
  public function width($val) { $this->width = $val; }
  public function height($val) { $this->height = $val; }
  public function set_markers($val) { $this->marker = $val; }

  public function add_marker($lat = null, $lon = null) 
  { 
    $lat = $lat ?? $this->lat;
    $lon = $lon ?? $this->lon;
    $this->marker[] = [$lat, $lon]; 
  }

  public function after_instanciation()
  {
    parent::after_instanciation();

    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\Webapp")):
      $this->topobj->moduleinfo['openstreetmap_org'] = true;
      if($this->topobj->moduleinfo['jquery']['use'] == '') $this->topobj->moduleinfo['jquery']['use'] = true;
    endif;
  }

  public function get_htmlonly() {
    return "<div id='osm_$this->id' style='width: $this->width; height: $this->height;'></div>";
  }

  public function get_js()
  {
    $code = "map_$this->id = new OpenLayers.Map('osm_$this->id');
        var mapnik = new OpenLayers.Layer.OSM();
        map_$this->id.addLayer(mapnik);
        map_$this->id.setCenter(new OpenLayers.LonLat($this->lon, $this->lat)
          .transform( new OpenLayers.Projection('EPSG:4326'), new OpenLayers.Projection('EPSG:900913')), $this->zoom);";

    if(sizeof($this->marker))
      $code .= "var markers = new OpenLayers.Layer.Markers('Markers'); map_$this->id.addLayer(markers);";

    foreach($this->marker as $marker)
      $code .= "markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat({$marker[1]}, {$marker[0]})
          .transform( new OpenLayers.Projection('EPSG:4326'), new OpenLayers.Projection('EPSG:900913'))));";

    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\webapp")):
      $this->topobj->add_jquery_ready($code);
      return '';
    else:
      return "\$(document).ready(function(){ $code });";
    endif;
  }

  public function get_html()
  {
    return $this->get_js() . $this->get_htmlonly();
  }
}
