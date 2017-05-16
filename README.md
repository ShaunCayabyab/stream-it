# streamtv
## Full-Stack TV Show Viewing Web Application

PHP web application similar to IMDB.com and Netflix. Users can register, login, view show and actor information, add shows to a queue, and watch episodes.

This application makes use of the CodeIgniter framework and its MVC architecture.

## DIRECTORY TREE
```
application
|-config
| |-config.php
| |-routes.php
|
|-controllers
| |-actor.php
| |-episodes.php
| |-home.php
| |-login.php
| |-queue.php
| |-search.php
| |-shows.php
| | watch.php
|
|-models
| |-actor_model.php
| |-customer_model.php
| |-show_model.php
|
|-views
  |-actor_view.php
  |-episodes_view.php
  |-home_view.php
  |-login_view.php
  |-queue_view.php
  |-search_view.php
  |-show_view.php
  |-shows_view.php
  |-single_episode_view.php
  |-watched_view.php
```

## DISCLAIMERS

`08/26/2016`
- Added proper documentation to the code

`08/17/2016`
- Still in the process of fully converting the web app into the CodeIgniter framework. Things like login and watching videos are yet to be functional.
- Still very little to none securty implementations for inputs.
- Will created better documentation for this project.