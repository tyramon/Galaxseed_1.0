<?php
/**
 * Created by PhpStorm.
 * User: webuser1801
 * Date: 20/06/2018
 * Time: 14:36
 */
declare(strict_types=1);

namespace dndcompany\galaxseed\controller;

class CoreController
{


    /**
     * Renders the view (aka makes a require() of the appropriate vue and extract() the variables(params))
     * @param string $controllerName
     * @param string $viewName
     * @param array $params
     */
    public function render(string $controller, string $view, array $params) : void
    {
        // $params est un tableau avec 'nom variable' => $variable comme sur Symfony.
        // autre solution serait de créer un attribut $params=[] dans le corController et faire des $this->setParams dans
        // les enfants pour ajouter des données au tableau (perso je préfère passer le tableau normal)

        // si il y a des params on les extrait pour faire des $variables pour l'affichage
        if ($params) {
            extract($params);
        }

        // exemple de chemin: dndcompany/galaxseed/controller/user/view/default.php
        if (file_exists(CONTROLLER_PATH . $controller . DS . 'view/' . $view . '.php'))
        {
            require(CONTROLLER_PATH . $controller . DS . 'view/' . $view . '.php');
        }
    }
}