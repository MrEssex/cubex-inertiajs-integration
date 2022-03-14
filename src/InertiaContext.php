<?php
namespace MrEssex\CubexInertiaJsProvider;

use Packaged\Context\Context;

class InertiaContext extends Context
{
  protected ?Inertia $_inertia = null;

  public function inertia()
  {
    if(!$this->_inertia instanceof Inertia)
    {
      $this->_inertia = Inertia::withContext($this);
    }
    return $this->_inertia;
  }
}
