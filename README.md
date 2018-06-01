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

Using The Precompiled Phar
------------

There's a `dist/worldcup18.phar` in the archive, built with [box2](https://github.com/box-project/box2). You can simply install it if you don't want to keep the source folder, or want to use the phar file from a PATH.

```bash
mv dist/worldcup18.phar /usr/local/bin/worldcup18
chmod +x /usr/local/bin/worldcup18
```

And you can simply use it like:

`worldcup18 fixtures all -t Germany`

License
-------------

[MIT License](http://emir.mit-license.org/)
