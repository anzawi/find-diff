# find-diff
calculate levenshtein distances &amp; hamming distances between 2 strings using PHP

--------
please note : PHP provided build-in functions to do what this library do
it's just for fun !

[levenshtein function](https://www.php.net/manual/en/function.levenshtein.php)

[gmp_hamdist function](https://www.php.net/manual/en/function.gmp-hamdist.php)


main Classes located in (`/libs/`) directory

## installation
- open your `terminal`/`cmd`/`powershell`
- navigate to your projects directory
- run `git clone https://github.com/anzawi/find-diff.git`
- navigate to project `cd find-diff`
- run `composer install`

this project require `find-diff` as a library
check `composer.json` file and take a look on `repositories` section.

### run test in command-line
- open your `terminal`/`cmd`/`powershell`
- navigate to project directory
- run `php runTest --s1="Mohammad" --s2="Mohammed"`

### run test project 
- run any preferred php server
- navigate to project
- you will see a simple form
- start testing

don't forget to run test using `phpunit`
`./vendor/bin/phpunit`

