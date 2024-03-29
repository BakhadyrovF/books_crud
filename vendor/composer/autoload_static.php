<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit285927598849996b2c60681b01d1f739
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit285927598849996b2c60681b01d1f739::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit285927598849996b2c60681b01d1f739::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit285927598849996b2c60681b01d1f739::$classMap;

        }, null, ClassLoader::class);
    }
}
