<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit41f427becb534eede9ea92f62a20faae
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'strobj\\' => 7,
        ),
        'W' => 
        array (
            'WaspCreators\\' => 13,
            'WPOauth\\' => 8,
            'WPEventsImporter\\' => 17,
        ),
        'L' => 
        array (
            'Liliumdev\\ICalendar\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'strobj\\' => 
        array (
            0 => __DIR__ . '/..' . '/uuur86/strobj/src',
        ),
        'WaspCreators\\' => 
        array (
            0 => __DIR__ . '/..' . '/uuur86/wasp/src/WaspCreators',
        ),
        'WPOauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/uuur86/wpoauth/src',
        ),
        'WPEventsImporter\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Liliumdev\\ICalendar\\' => 
        array (
            0 => __DIR__ . '/..' . '/liliumdev/icalendar/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit41f427becb534eede9ea92f62a20faae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit41f427becb534eede9ea92f62a20faae::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
