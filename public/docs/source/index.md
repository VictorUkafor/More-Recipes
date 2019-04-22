---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_fb963cd2a8a1aea083363e2d2f4d272a -->
## sign up a user.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/signup" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/auth/signup",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/auth/signup`


<!-- END_fb963cd2a8a1aea083363e2d2f4d272a -->

<!-- START_2be1f0e022faf424f18f30275e61416e -->
## login a user.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/auth/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/auth/login`


<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_157d8ad79ead4900498aa93abc060df0 -->
## details api

> Example request:

```bash
curl -X GET "http://localhost/api/v1/auth/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/auth/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/auth/user`

`HEAD api/v1/auth/user`


<!-- END_157d8ad79ead4900498aa93abc060df0 -->

<!-- START_8f19f74006176e31186973507712f4f8 -->
## stores a recipe to the database.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/recipes" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/recipes`


<!-- END_8f19f74006176e31186973507712f4f8 -->

<!-- START_e96c3a5a197bf92279c68ffdd0456c1b -->
## updates a single recipe

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/recipes/{recipeId}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes/{recipeId}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/recipes/{recipeId}`


<!-- END_e96c3a5a197bf92279c68ffdd0456c1b -->

<!-- START_9b2fd453ecb9f8a8a5b47fc3f7fffd1e -->
## soft deletes a recipes

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/recipes/{recipeId}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes/{recipeId}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/recipes/{recipeId}`


<!-- END_9b2fd453ecb9f8a8a5b47fc3f7fffd1e -->

<!-- START_6c899b10959696e5c85e0c4e1d0387ef -->
## makes a reaction.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/recipes/{recipeId}/reaction" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes/{recipeId}/reaction",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/recipes/{recipeId}/reaction`


<!-- END_6c899b10959696e5c85e0c4e1d0387ef -->

<!-- START_1c1e1c84f9af091e54af89937a739b5c -->
## Adds a favourite.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/recipes/{recipeId}/favourite" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes/{recipeId}/favourite",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/recipes/{recipeId}/favourite`


<!-- END_1c1e1c84f9af091e54af89937a739b5c -->

<!-- START_e6f63b62d58b6a43a11393be894af978 -->
## display all recipes.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/recipes" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "recipes": {
        "current_page": 1,
        "data": [
            {
                "id": 3,
                "user_id": 2,
                "name": "Fried Rice and Egg10",
                "ingredients": "rice, beans",
                "method": "hiuhw hiuhw ewfuw g df bdubgcghugggy",
                "image": "FriedRiceandEgg10",
                "deleted_at": null,
                "created_at": "2019-04-20 14:25:31",
                "updated_at": "2019-04-20 14:25:31",
                "upvotes": 2,
                "downvotes": 0
            },
            {
                "id": 2,
                "user_id": 2,
                "name": "Fried Rice and Egg7",
                "ingredients": "rice, beans",
                "method": "hiuhw hiuhw ewfuw g df bdubgcghugggy",
                "image": "FriedRiceandEgg7",
                "deleted_at": null,
                "created_at": "2019-04-20 14:22:45",
                "updated_at": "2019-04-20 14:22:45",
                "upvotes": 0,
                "downvotes": 1
            },
            {
                "id": 1,
                "user_id": 2,
                "name": "Fried Rice and Egg4",
                "ingredients": "rice, beans",
                "method": "hiuhw hiuhw ewfuw g df bdubgcghugggy",
                "image": "FriedRiceandEgg4",
                "deleted_at": null,
                "created_at": "2019-04-20 13:06:00",
                "updated_at": "2019-04-20 13:06:00",
                "upvotes": 1,
                "downvotes": 0
            }
        ],
        "from": 1,
        "last_page": 1,
        "next_page_url": null,
        "path": "http:\/\/localhost\/api\/v1\/recipes",
        "per_page": 8,
        "prev_page_url": null,
        "to": 3,
        "total": 3
    }
}
```

### HTTP Request
`GET api/v1/recipes`

`HEAD api/v1/recipes`


<!-- END_e6f63b62d58b6a43a11393be894af978 -->

<!-- START_6caaae685c2f4726a91d1f15ab6811ba -->
## display a single recipe

> Example request:

```bash
curl -X GET "http://localhost/api/v1/recipes/{recipeId}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recipes/{recipeId}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "recipe": {
        "id": 1,
        "user_id": 2,
        "name": "Fried Rice and Egg4",
        "ingredients": "rice, beans",
        "method": "hiuhw hiuhw ewfuw g df bdubgcghugggy",
        "image": "FriedRiceandEgg4",
        "deleted_at": null,
        "created_at": "2019-04-20 13:06:00",
        "updated_at": "2019-04-20 13:06:00",
        "upvotes": 1,
        "downvotes": 0
    }
}
```

### HTTP Request
`GET api/v1/recipes/{recipeId}`

`HEAD api/v1/recipes/{recipeId}`


<!-- END_6caaae685c2f4726a91d1f15ab6811ba -->

