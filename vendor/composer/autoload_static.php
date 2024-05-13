<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda1f3819e28f48a3fd0dac3e651427fd
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Shoyim\\ORM\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Shoyim\\ORM\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitda1f3819e28f48a3fd0dac3e651427fd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda1f3819e28f48a3fd0dac3e651427fd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda1f3819e28f48a3fd0dac3e651427fd::$classMap;

        }, null, ClassLoader::class);
    }
}
