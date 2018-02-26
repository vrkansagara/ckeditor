<?php
namespace Ckeditor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {


  private $moduleSlug;
  private $config;

  public function __construct() {
    $this->moduleSlug = 'ckeditor';
  }

  private function getConfig() {
    $appConfig = $this->getServiceLocator()->get('config');
    if (null === $this->config) {
      $this->config = $appConfig['Ckeditor'];
    }

    return $this->config;
  }



  public function indexAction() {
    $request = $this->getRequest();
    if ($request->getContent()) {
      echo '<pre>';
      print_r($request->getContent());
      echo __FILE__;
      echo __LINE__;
      exit(0);
    }

    return new ViewModel();

  }

  public function saveAction() {
    $this->getConfig();
    $request = $this->getRequest();

    if ($request->isPost()) {
      $postData = $request->getPost();
      $editorData = $request->getPost('editor');
      $title = $request->getPost('title');
      $tags = $request->getPost('tags');
      $fileId = $this->config['postDir'] .'/'.preg_replace('/\s+/', '_', $title);
      $this->write($fileId,$editorData);

      return $this->url($this->moduleSlug);
    }
  }


  public function write($filename, $data)
  {
    // Ensure the directory exists before writing to it
    $dir = dirname($filename);
    if (!file_exists($dir) || !is_dir($dir)) {
      mkdir($dir, 0777, true);
    }
    file_put_contents($filename, $data);
  }


}