<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 27/06/2018
 * Time: 11:39
 */

namespace dndcompany\galaxseed\controller\home;

use dndcompany\galaxseed\controller\CoreController;


class HomeController extends CoreController
{
    protected $controller;   // controller name is used in the render to build the path


    public function __construct()
    {
        $this->controller = 'home';
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }


    /**
     * returns the homepage
     */
    public function defaultAction()
    {
        return $this->render($this->getController(),'default', []);
    }

}