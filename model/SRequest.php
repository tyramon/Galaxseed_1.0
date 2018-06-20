<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 09:59
 */

namespace dndcompany\galaxseed\model;


class SRequest
{
    private $post;
    private $get;
    private $session;

    protected static $instance;

    private function __construct()
    {
        if( is_null( session_id() ) )
        {
            session_start();
        }

        $this->post = $_POST;
        $this->get = $_GET;
        $this->session = &$_SESSION;
        $_POST = $_GET = null;
    }

    /**
     * Returns the instance of SRequest
     * @return SRequest
     */
    public static function getInstance()
    {
        if( !isset( self::$instance ) ) {
            self::$instance = new SRequest();
        }
        return self::$instance;
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function post($key = null )
    {
        if( isset( $key ) ){
            return $this->post[$key];
        }else{
            return $this->post;
        }
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function get($key = null )
    {
        if( isset( $key ) ){
            return $this->get[$key];
        }else{
            return $this->get;
        }
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function getSession($key = null )
    {
        if( isset( $key ) ){
            return $this->session[(string)$key];
        }else{
            return $this->session;
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function setSession($key, $value )
    {
        $this->session[$key] = (string)$value;
    }
} //End of class