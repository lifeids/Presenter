<?php

declare(strict_types=1);

/*

 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeids\Presenter\Traits;

use Carbon\Carbon;

trait DateTimeTrait
{
    /**
     * @param bool   $timeAgo
     * @param string $format
     *
     * @return string
     */
    public function createdAt($timeAgo = false, $format = 'd.m.Y'): string
    {
        return $timeAgo ? $this->getTimeAgo($this->created_at) : $this->created_at->format($format);
    }

    /**
     * @param bool   $timeAgo
     * @param string $format
     *
     * @return string
     */
    public function updatedAt($timeAgo = false, $format = 'd.m.Y'): string
    {
        return $timeAgo ? $this->getTimeAgo($this->updated_at) : $this->updated_at->format($format);
    }

    /**
     * @param bool   $timeAgo
     * @param string $format
     *
     * @return string
     */
    public function deletedAt($timeAgo = false, $format = 'd.m.Y'): string
    {
        return $timeAgo ? $this->getTimeAgo($this->deleted_at) : $this->deleted_at->format($format);
    }

    /**
     * @param $dateTime
     *
     * @return string
     */
    public function getTimeAgo($dateTime): string
    {
        return Carbon::createFromTimeStamp(strtotime((string) $dateTime))->diffForHumans();
    }
}
