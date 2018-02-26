<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 26/02/18
 * Time: 8:06 AM
 */

namespace Ckeditor\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();

    }

}