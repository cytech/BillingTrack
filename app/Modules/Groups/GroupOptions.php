<?php

namespace BT\Modules\Groups;

class GroupOptions
{
    public function resetNumberOptions()
    {
        return [
            '0' => trans('bt.never'),
            '1' => trans('bt.yearly'),
            '2' => trans('bt.monthly'),
            '3' => trans('bt.weekly'),
        ];
    }
}
