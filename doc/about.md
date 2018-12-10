#About

This is a quick sample php project that implements a MVC pattern in an simple and hopefully understandable way.

I created this in the hope it will help others to better understand MVC on their learning path.

Please be aware that this project does not intend to reflect all the industry best practices or security concerns 
but rather tries to make easy and visible to understand how a MVC implementation works in some PHP frameworks

This project will allow users to login, admin users will be able to view and create other users (admin and not admin)
and on creation setup one of the meteorological stations. Every user on login will get the weather information
for his configured station.

# MVC structure
This implementation uses a front controller to deal with all requests and route them according to the application 
settings. Using a front controller is a common practice but some applications might decide to use more than one,
for example for front end and backend separation.
 
The request is handed over from the front controller to init.php where the database and authentication modules 
are initialized, and then the navigation module takes care of routing the request to the correct controller

## Controller

The navigation is performed based on GET parameters that define controller and action `?c=<controller>&a=<action>`
the controller must exist within the controller folder with name convention `<controler>Controller.php`
this file has to contain a class that follows the same convention `<controler>Controller` and the 
actions are methods of the class with the convention `<action>Action`

within the controller you can then invoke models and pass values to the views for rendering

```php
// redirect to the login page
$navigation->redirect("Front","login");

// load the login tpl for rendering
$navigation->includetpl("front/login.tpl.php");
```

## Models

Models do the heavy work of the application, you might have models that map 1:1 to database tables and allow a direct 
interaction with the table, a classic example is a products table with methods like add `addProduct()` or `viewPrice()`

In this case the sample model `meteoGalicia.model.php` will perform a sub request to a meteo station to get information about the stations and the 
weather.

## View

The view is intended to render the content that it becomes from the controller, views should be easily editable by 
designers and use a basic subset of code functions. 

A lot of frameworks delegate that to templating engines. 

#Folders
__class__ contains helper classes

__controller__ contains the different controllers for your application

__core__ contains the MVC framework classes

__data__ contains application data

__model__ contains your application defined models

__public__ contains the public exposed data
 
__view__ contains your application defined views
