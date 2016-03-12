<?php

include 'api.php';

class APIRouter {
  private function basePath(){
    $pop = explode("/",$_SERVER['SCRIPT_NAME']);
    array_pop($pop);
    return implode('/',$pop);
  }
  private function hyphenToUnderscore($value){
    $value = str_replace('-', '_', $value);
    return $value;
  }
  private function determineRoute(){
    $route = explode('/',substr($_SERVER['REDIRECT_URL'],
      strlen($this->basePath())+1,
      strlen($_SERVER['REDIRECT_URL'])));
      $route = array_map(array($this,'hyphenToUnderscore'), $route);
      print_r($route);
    return $route;
  }
  function routeToController(){
    $directive = $this->determineRoute();
    if(isset($directive[0]) && isset($directive[1])){
      $fname = $directive[0] . '/' .$directive[1] . ".php";
      if(file_exists($fname)){
        include $directive[0] . '/' .$directive[1] . ".php";
        $cmd = new $directive[1]();
        if(isset($directive[2]) && method_exists($cmd, $directive[2])){
          //call method;
          $cmd->$directive[2]();
        }
      }

    }
  }
}
$router = new APIRouter();

//
// $directory = '.';
// $scanned_directory = array_diff(scandir($directory), array('..', '.'));
// foreach($scanned_directory as $dir){
//   if(is_dir($dir)){
//     //this is a file that contains items;
//     $more = array_diff(scandir($dir), array('..', '.'));
//     print_r($more);
//     foreach($more as $item){
//       include $dir. '/'.$item;
//       $class = explode('.',$item);
//       array_pop($class);
//       $class = implode('.', $class);
//       if(class_exists($class)){
//         echo $class . ":<br>";
//         print_r(array_diff(get_class_methods($class), array('__construct')));
//       }
//
//     }
//   }
//   echo $dir . "<br>";
// }




$router->routeToController();


 ?>
