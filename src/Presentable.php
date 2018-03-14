<?php

declare(strict_types=1);

/*

 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeids\Presenter;

trait Presentable
{
    /**
     * View presenter instance.
     *
     * @var mixed
     */
    protected $presenterInstance;

    /**
     * Prepare a new or cached presenter instance.
     *
     * @throws PresenterException
     *
     * @return mixed
     */
    public function present()
    {
        $presenterClass = $this->getPresenterClass();

        if (!class_exists($presenterClass)) {
            throw new Exceptions\PresenterException('The specified presenter does not exist.');
        }

        if (!$this->presenterInstance) {
            $this->presenterInstance = new $presenterClass($this);
        }

        return $this->presenterInstance;
    }

    /**
     * Get the view presenter for the model.
     *
     * @return string
     */
    protected function getPresenterClass(): string
    {
        return 'App\\Presenters\\'.class_basename($this);
    }
}
