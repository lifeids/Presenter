<?php

declare(strict_types=1);

/*

 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeids\Presenter\Traits;

trait RoutesTrait
{
    /**
     * @var bool
     */
    protected $appendEntityRouteKey = true;

    /**
     * @return string
     */
    public function indexRoute(): string
    {
        return $this->buildRoute('index');
    }

    /**
     * @return string
     */
    public function createRoute(): string
    {
        return $this->buildRoute('create');
    }

    /**
     * @return string
     */
    public function storeRoute(): string
    {
        return $this->buildRoute('store');
    }

    /**
     * @return string
     */
    public function showRoute(): string
    {
        return $this->buildRoute('show', true);
    }

    /**
     * @return string
     */
    public function editRoute(): string
    {
        return $this->buildRoute('edit', true);
    }

    /**
     * @return string
     */
    public function updateRoute(): string
    {
        return $this->buildRoute('update', true);
    }

    /**
     * @return string
     */
    public function deleteRoute(): string
    {
        return $this->buildRoute('destroy', true);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return $this->entity->getRouteKeyName();
    }

    /**
     * @return array
     */
    public function getRouteParameters(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getRoutePrefix(): string
    {
        return strtolower(str_plural(class_basename(get_class($this->entity))));
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function routeName(string $key): string
    {
        return $this->getRoutePrefix().".$key";
    }

    /**
     * @return string
     */
    protected function buildRoute($name, $keyName = false): string
    {
        $name = $this->routeName($name);

        return $keyName ? route($name, $this->buildRouteParameters()) : route($name);
    }

    /**
     * @return array
     */
    protected function buildRouteParameters(): array
    {
        $parameters = [];
        foreach ($this->getRouteParameters() as $segment) {
            $this->loadRelationship($segment);

            $parameters[] = object_get($this->entity, $segment);
        }

        if ($this->appendEntityRouteKey) {
            $parameters[] = object_get($this->entity, $this->getRouteKeyName());
        }

        return $parameters;
    }

    /**
     * Eager-Load a relationship from the given segment.
     *
     * @param string $segment
     */
    private function loadRelationship($segment)
    {
        $column = last(explode('.', $segment));

        $relationship = str_replace(".$column", null, $segment);

        $this->entity->load($relationship);
    }
}
