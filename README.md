## Installation

Use the following commands to install the application dependencies.
```yaml
$ composer install
$ yarn install
$ npm install
```
After that use
```yaml
$ symfony serve
```
to start the application locally.

If symfony is not installed, use
```yaml
$ curl -sS https://get.symfony.com/cli/installer | bash 
```

---
## Interface
1. Simple form that accepts an integer. After submitting it, the api is being called to calculate the packs.
2. Api url: `api/{amountOfWidgets}`


## Command lines
Running tests using PHPUnit
```
$ make unit
```
Currently, there are several unit tests defined.

```
$ make analysis
```
Running static analysis using PHPStan
