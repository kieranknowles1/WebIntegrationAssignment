# KF6012 Web Application Integration Assignment
Kieran Knowles - w20013000

## URLs

### API
TODO: API Endpoint URLs and parameters

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

The private key for token signing is included in `./server/config/settings.php`. Note that this would normally not
be included in a public repository, but is included here for the purposes of this assignment.

### Web App
While not written in TypeScript, the web app is checked by VS Code's TypeScript language server configured in
`./app/jsconfig.json`. This allows for type checking through inferred types and JSDoc comments without depending on
the TypeScript compiler.

The app's code is lined using ESLint with the StandardJS ruleset. This is configured in `./app/.eslintrc.cjs`.
