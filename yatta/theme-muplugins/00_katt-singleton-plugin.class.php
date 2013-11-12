<?php
/**
 * Class SingletonPlugin
 *
 * Singleton Pattern
 *
 * @package Kattagami
 * @version 1.0.0
 * @author Gilles Vauvarin
 * @copyright
 * @link http://kattagami.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/*
*
* In almost every situation, plugin classes should only be called once, and this rule should be enforced in code.
* The Singleton Pattern provides a method for limiting the number of instances of an object to just one.
* For WordPress plugin classes, we want to store all of our actions and filters in a constructor or a class’s init() method. 
* We don’t want to register those filters and actions more than once. We also don’t need or want multiple instances of our plugin
* class. This makes a plugin class a perfect candidate to implement the Singleton pattern.
*
* Abstract class (SingletonPlugin) allows us not repeating code in every MyClassPlugin. Your MyClassPlugin just needs to extend
* SingletonPlugin.
*
* MyClassPlugin must extend SingletonPlugin, indeed it will inheriting all of SingletonPlugin qualities.
* MyClassPlugin will implement the required abstract function init().
* MyClassPlugin cannot be instantiated with the "new" keyword, the constructor is protected..
* MyClassPlugin is instantiated with a static method, but because an instance is created, $this can be used throughout its methods
*
*
* @version 1.0.0
* @author Scott Taylor
* @author_url http://scotty-t.com
* @see http://scotty-t.com/2012/07/09/wp-you-oop/?blogsub=confirming#subscribe-blog
*
* Probably the best place for this file to go is wp-content/mu-plugins
* 
*/


abstract class SingletonPlugin {

    // Properties
    private static $instance = array();

    // Constructor
    protected function __construct() {}

    // Methods
    public static function get_instance() {
        $c = get_called_class();
        if ( !isset( self::$instance[$c] ) ) {
            self::$instance[$c] = new $c();
            self::$instance[$c]->init();     
        }

        return self::$instance[$c];
    }   

    abstract public function init(); 

}