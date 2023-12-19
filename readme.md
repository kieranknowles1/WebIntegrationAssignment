# KF6012 Web Application Integration Assignment
Kieran Knowles - w20013000

## URLs

### API
The API is hosted on nuwebspace at the following URL:
https://w20013000.nuwebspace.co.uk/api/

Documentation is provided in the OpenAPI format and hosted on nuwebspace at the following URL:
https://w20013000.nuwebspace.co.uk/redoc-static.html

This is specified in `./docs/api.yml` and can be built using the `redocly` and the included `npm run build` script.

### Web App
The web app is hosted on nuwebspace at the following URL:
https://w20013000.nuwebspace.co.uk/app/

## Additional Information

### API
The firebase-jwt package is included in the `.gitignore` file and must be installed manually if cloning this repository
using the following command:
```bash
cd server
composer install
```

Similarly, the `users.sqlite` file is not included and must be created manually from the `users.schema.sql` file in the
`./server/data` directory.

The private key for token signing is included in `./server/config/settings.php`. Note that this would normally not
be included in a public repository, but is included here for this assignment.

PHPStan is used to check the API's code and is configured in `./server/phpstan.neon`
to use the highest level of strictness with features such as type and nullability checks enabled.

Should an unhandled exception occur, the API will return a 500 error with a generic message. This is to prevent
sensitive information from being leaked to the client. The exception will be logged to the server's error log in `./data/error.log` in
the following format:
```json
{
    "timestamp": 1702997866,
    "message": "Not implemented",
    "file": "/var/www/html/src/App/Endpoints/Developer.php",
    "line": 15,
    "stacktrace": [
        {
            "file": "/var/www/html/src/App/Endpoints/Endpoint.php",
            "line": 92,
            "function": "handleGetRequest",
            "class": "App\\Endpoints\\Developer",
            "type": "->"
        },
        {
            "file": "/var/www/html/api/api.php",
            "line": 18,
            "function": "handleRequest",
            "class": "App\\Endpoints\\Endpoint",
            "type": "->"
        }
    ]
}
```

### Web App
While not written in TypeScript, the web app is checked by VS Code's TypeScript language server configured in
`./app/jsconfig.json`. This allows for type checking through inferred types and JSDoc comments without depending on
the TypeScript compiler. Most strict checks are enabled, with the exception of `noImplicitAny` as it would be unwieldy to implement with JSDoc comments.

Component properties are checked using PropTypes, TypeScript uses this to
check that the properties are passed and are of the correct type.

The app's code is lined using ESLint with the StandardJS ruleset. This is configured in `./app/.eslintrc.cjs`.
As this ruleset checks for undefined variables, there is no need to add `'use strict'` to the top of each file.
