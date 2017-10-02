# Bundesliga API

---

This is a small app API wrapper for the [OpenLigaDB API](https://www.openligadb.de/).

At first you will find information about:
- Next upcoming matches (following Gameday)
- All matches of the actual season
- Win/Loss Ratio of the actual season of each team

## Solution workflow

The main idea is to wrap the original OpenLigaDB API with a graphQL schema to make the frontend queries easy and declarative.
I choose the JSON format for convenience and better knowledge of the format.

On the frontend there's a React app with the Apollo client querying the graphQL backend.  

## To run

1. First install all dependencies
```bash
$ composer install
$ npm install
```

2. Compile the frontend assets
```bash
$ npm run prod
```

3. Run the php server
```bash
$ php artisan serve
```
>make sure you have PHP 7 at your PATH

4. browse localhost:8000 and enjoy!