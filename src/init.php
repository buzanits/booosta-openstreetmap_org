<?php
namespace booosta\openstreetmap_org;

\booosta\Framework::add_module_trait('webapp', 'openstreetmap_org\webapp');

trait webapp
{
  protected function preparse_openstreetmap_org()
  {
    if($this->moduleinfo['openstreetmap_org'])
      $this->add_includes("<script src='https://openlayers.org/api/OpenLayers.js'></script>");
  }
}
