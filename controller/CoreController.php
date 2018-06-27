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

    public function __construct()
    {
    }


    /**
     * Renders the home (aka makes a require() of the appropriate vue and extract() the variables(params))
     * @param string $controllerName
     * @param string $viewName
     * @param array $params
     */
    public function render(string $controller, string $view, array $params)
    {
        // $params est un tableau avec 'nom variable' => $variable comme sur Symfony.
        // autre solution serait de créer un attribut $params=[] dans le corController et faire des $this->setParams dans
        // les enfants pour ajouter des données au tableau (perso je préfère passer le tableau normal)

        // si il y a des params on les extrait pour faire des $variables pour l'affichage
        if ($params) {
            extract($params);
        }

        $viewPath = 'controller\\' . $controller . DS . 'view' . DS . $view . '.php';

        // exemple de chemin: dndcompany/galaxseed/controller/user/home/default.php
        if (file_exists($viewPath))
        {
           return  require($viewPath);
        }

        return 'fichier inexistant';

    }
}