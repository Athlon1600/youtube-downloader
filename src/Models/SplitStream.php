<?php

namespace YouTube\Models;

class SplitStream extends AbstractModel
{
    /** @var StreamFormat */
    public $video;
    /** @var StreamFormat */
    public $audio;
}