<?php

namespace Devrtips\Listr\Parameter;

interface ParameterInterface
{

    /**
     * Get filters matching the given identifier.
     *
     * @param string $identifier
     * @return array
     */
    public function getFilterParameters($identifier);

    /**
     * Get sorters matching the given identifier.
     *
     * @param string $identifier
     * @return array
     */
    public function getSorterParameters($identifier);
}
