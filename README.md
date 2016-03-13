# SimpleAPI
Simple API server written in PHP

All you really need to do is download this script and place in on your webserver. you can program it to use any kind of methods, extend it with composer and 3rd party libraries.

## What is it?
SimpleAPI is the simplest way for you to create an API server using PHP. It defines a structure for versions, controllers, and methods.

**Versions** are directories created within the root api directory. You do this so you can test new versions, as well as, migrate from one version to another seamlessly, in the future.

Below is how the directory structure should look
```
simple-api
└───api
    └───version
        │   controller.php
        │   controller_two.php
        │   ...

```

**Controllers** are PHP classes, which are named exactly the same as it would appear in the request url, with the exception that dashes in the request uri are rewritten as underscores. So, if your request uri looks like this: /v1/new-user, the corresponding PHP class would be named new_user.

**Methods** are class methods or functions which belong to the controller.


## Sample API Method
Below is the code for a sample method:

```php
class hello {
  public function world(){
    $API = SimpleAPI::getInstance();
    $API->setParameter('response', 'hello world');
    $API->sendResponse();
    }
  }
```

When you go to the following request uri: /v1/hello/world, you will see the following response:

    {"status":"200", "response":"hello world"}

## Log errors
It's easy to log errors and set error codes. The code below will do the trick:

```php
class hello {
  public function world(){
    $API = SimpleAPI::getInstance();
    if(!isset($earth)){
      $API->statusCode("400"); //can be set as a string or long
      $API->logError("There is no Earth!");

      /* alternatively you could string these methods together:
      $API->statusCode("400")->logError("There is no Earth!")
      */
    } else {
      $API->setParameter('response', 'hello world');
    }
    $API->sendResponse();
    }
  }
```
The above method will return the following response:

```
{"errors":["There is no Earth!"], "status":"400"}
```
