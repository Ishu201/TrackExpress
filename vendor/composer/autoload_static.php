<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit74d21bb129d9d5eec698fa89efc0a18d
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit74d21bb129d9d5eec698fa89efc0a18d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit74d21bb129d9d5eec698fa89efc0a18d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit74d21bb129d9d5eec698fa89efc0a18d::$classMap;

        }, null, ClassLoader::class);
    }
}
