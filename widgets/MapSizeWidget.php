<?php

namespace delahaye\googlemaps;

class MapSizeWidget extends \ImageSize
{
    /**
     * Trim values
     *
     * @param mixed $varInput
     *
     * @return mixed
     */
    protected function validator($varInput)
    {
        $varInput[0] = $varInput[0] ? (int) $varInput[0] : '';
        $varInput[1] = $varInput[1] ? (int) $varInput[1] : '';

        return $varInput;
    }
}
