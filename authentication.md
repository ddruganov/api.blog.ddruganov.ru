### Authentication via hub

1. visit todo.ddruganov.ru
2. fail to authenticate
3. get redirected to hub with an app uuid
4. log in
5. get redirected to todo.ddruganov.ru/auth/login with both tokens as query params
6. post to api.todo.ddruganov.ru/auth/login with the access token
7. get logged on
8. attach an access token with each request in the authorization bearer header
9. refresh tokens when the app returns a 401
