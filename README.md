World Cup 2018
=================

2018 FIFA World Cup results for hackers.

[http://api.football-data.org/index](http://api.football-data.org/index)

Data Source: [http://api.football-data.org/v1/soccerseasons/424](http://api.football-data.org/v1/soccerseasons/424)

<img src="screenshot.png" />


### Installing

After cloning the repository:

```
composer install
```

**Important: You should set date.timezone on your php.ini**


Usage
------------

`php app.php fixtures`

Default argument is today. Also **current**, **finished** and **all** are supported arguments.
With argument **all** you can specified team you want to see schedule/results. For example:

`php app.php fixtures all -t Germany`

You can always add **worldcup18** alias on your .bashrc or .zshrc (That's how I use)

`alias worldcup18='php projects/worldcup2018/app.php fixtures'`

and use like this:

`worldcup18 current`

License
-------------

[MIT License](http://emir.mit-license.org/)
