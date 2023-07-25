<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit74d21bb129d9d5eec698fa89efc0a18d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit74d21bb129d9d5eec698fa89efc0a18d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit74d21bb129d9d5eec698fa89efc0a18d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit74d21bb129d9d5eec698fa89efc0a18d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
