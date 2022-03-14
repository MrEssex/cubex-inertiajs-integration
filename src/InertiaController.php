<?php
namespace MrEssex\CubexInertiaJsProvider;

use Exception;
use Packaged\Context\Context;
use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Context\WithContext;
use Packaged\Context\WithContextTrait;
use RuntimeException;

class InertiaController implements ContextAware, WithContext
{
  use ContextAwareTrait;
  use WithContextTrait;

  /**
   * @throws Exception
   */
  public function getContext(): Context
  {
    if($this->_context instanceof InertiaContext)
    {
      return $this->_context;
    }

    throw new RuntimeException('Context must be an instance of InteriaContext');
  }

  /**
   * @param string $component
   * @param array  $params
   *
   * @return array
   * @throws Exception
   */
  public function inertia(string $component, array $params = [])
  {
    return [
      'component' => $component,
      'props'     => $this->_getInertiaProps($params),
      'url'       => $this->_getInertiaUrl(),
      'version'   => $this->_getInertiaVersion(),
    ];
  }

  /**
   * @throws Exception
   */
  protected function _getInertiaProps(array $params): array
  {
    return array_merge($this->getContext()->inertia()->getSharedProps(), $params);
  }

  /**
   * @throws Exception
   */
  protected function _getInertiaUrl(): string
  {
    return $this->getContext()->request()->url();
  }

  /**
   * @throws Exception
   */
  protected function _getInertiaVersion()
  {
    return $this->getContext()->inertia()->getVersion();
  }
}
