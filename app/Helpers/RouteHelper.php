<?php


namespace App\Helpers;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RouteHelper
{
    public static function includeRouteFiles(string $folder)
    {
        // iterate through the v1 folder recursively
        $dirIterator = new RecursiveDirectoryIterator($folder);

        /** @var RecursiveDirectoryIterator | RecursiveIteratorIterator $it */
        $it = new RecursiveIteratorIterator($dirIterator);

        //require the file in each iteration
        while($it->valid()){
            if(!$it->isDot()
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php')
            {
                /** @noinspection PhpIncludeInspection */
                require $it->key();
            }
            $it->next();
        }
    }
}
