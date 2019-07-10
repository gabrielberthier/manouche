# manouche
### Manouche is a modern microframework built using PHP language and different libraries to provide a unique solution to start a PHP project from scratch.
It provides a set of HTTP helpers, middlewares, routes, controllers, models, etc; besides being able to handle Dependency Injection thanks to PHP-DI.
I have used some different libraries, most of them from Symsonfy Framework and League. The router system works using League\Route, which is a router system made on top of Nikita Popov's Fast Route, and HTTP request and response, as long as other PHP globals are used within Zend Diactoros, based on PSR-7.
The template engine is handled by Twig.
I don't use Session vars neither store session-cookies, because for future integration I preferred using JWT approach to store session data.
Hope you enjoy using it!
