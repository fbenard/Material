Material
========

Material is an ORM written in PHP, for PHP applications. It has been designed to work perfectly as a stand-alone component, so that you can use it in any environment, with any framework. Material provides:

- Support of all native database drivers (via PDO)
- Simultaneous connections to databases
- A query builder
- A schema builder
- A model class to play with PHP objects
- Support of custom object lifecycles
- Localized properties
- A migration and seeding mechanism

![Build status](https://circleci.com/gh/fbenard/material/tree/master.svg?style=shield&circle-token=f5b255ed7a134e386373a77c9781633083c9c1a3)


## Install

Simply add `fbenard/material` to your `composer.json`:

```json
{
	"require": 
	{
		"fbenard/material": "*"
	}
}
```

And update:

```
composer update
```


## Authors

Material is carefully taken care of by [Fabien BÉNARD](http://fabien.benard.co).


## License

The code for Material is distributed under the terms of the MIT license. See [LICENSE.txt](LICENSE.txt) for the full license.
