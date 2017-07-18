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
        $varInput[0] = parent::validator($varInput[0]);
        $varInput[1] = parent::validator($varInput[1]);

        return $varInput;
    }
}
