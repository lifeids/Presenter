<?php

declare(strict_types=1);

/*

 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeids\Presenter;

class BasePresenter extends Presenter
{
    use Traits\RoutesTrait;
    use Traits\DateTimeTrait;
}
