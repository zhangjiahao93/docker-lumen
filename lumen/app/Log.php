<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'started_at', 'finished_at', 'value', 'description'
    ];
    const FEED = 1;
    const COMPLEMENT = 2;
    const DIAPER = 3;
    const SLEEP = 4;

    const TYPE = [
        self::FEED => '喂奶',
        self::COMPLEMENT => '辅食',
        self::DIAPER => '换尿布',
        self::SLEEP => '睡眠'
    ];
    const KEY = [
        self::FEED => [],
        self::COMPLEMENT => '辅食',
        self::DIAPER => '换尿布',
        self::SLEEP => '睡眠'
    ];
    







    


}
