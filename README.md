
![alt text][logo]

[logo]: http://www.nyguild.org/system/html/Timeinc3-ef9294aa.png "Logo Time Inc"

# Test - JSONPlaceholder API

This API provides a Client for the [JSONPlaceholder API](https://jsonplaceholder.typicode.com)

This [Symfony 2](https://symfony.com/) project uses basic bundles/components such as:
 - [Fractal](http://fractal.thephpleague.com/)
 - [Guzzle](https://github.com/guzzle/guzzle)
 - [JMSSerializerBundle](https://github.com/schmittjoh/JMSSerializerBundle)

## Installation

Your environment must be setup with composer:
```bash
composer update 
```

## Run the server

```bash
app/console server:run
```

## API

#### Endpoints
###### /favourite_posts

Using the *id* query parameter:
```bash
# Using httpie
http http://127.0.0.1:8000/favourite_posts \ 
    id[]==4 \ 
    id[]==6


>>> HTTP/1.1 200 OK
>>> Cache-Control: no-cache
>>> Connection: close
>>> Content-Type: application/json
>>> Host: 127.0.0.1:8000
>>> X-Debug-Token: 702834
>>> X-Debug-Token-Link: http://127.0.0.1:8000/_profiler/702834
>>> X-Powered-By: PHP/5.6.22
>>> [
>>>     {
>>>         "body": "ullam et saepe reiciendis voluptatem adipisci\nsit amet autem assumenda provident rerum culpa\nquis hic commodi nesciunt rem tenetur doloremque ipsam iure\nquis sunt voluptatem rerum illo velit", 
>>>         "post_id": 4, 
>>>         "title": "eum et est occaecati", 
>>>         "user": {
>>>             "email": null, 
>>>             "id": 1, 
>>>             "name": null
>>>         }
>>>     }, 
>>>     {
>>>         "body": "ut aspernatur corporis harum nihil quis provident sequi\nmollitia nobis aliquid molestiae\nperspiciatis et ea nemo ab reprehenderit accusantium quas\nvoluptate dolores velit et doloremque molestiae", 
>>>         "post_id": 6, 
>>>         "title": "dolorem eum magni eos aperiam quia", 
>>>         "user": {
>>>             "email": null, 
>>>             "id": 1, 
>>>             "name": null
>>>         }
>>>     }
>>> ]

```

Default parameters queries the following Post IDs (35, 48, 91, 150)
```bash
# Using httpie
http http://127.0.0.1:8000/favourite_posts


>>> HTTP/1.1 200 OK
>>> Cache-Control: no-cache
>>> Connection: close
>>> Content-Type: application/json
>>> Host: 127.0.0.1:8000
>>> X-Debug-Token: ea91a2
>>> X-Debug-Token-Link: http://127.0.0.1:8000/_profiler/ea91a2
>>> X-Powered-By: PHP/5.6.22
>>> [
>>>     {
>>>         "body": "nisi error delectus possimus ut eligendi vitae\nplaceat eos harum cupiditate facilis reprehenderit voluptatem beatae\nmodi ducimus quo illum voluptas eligendi\net nobis quia fugit", 
>>>         "post_id": 35, 
>>>         "title": "id nihil consequatur molestias animi provident", 
>>>         "user": {
>>>             "email": null, 
>>>             "id": 4, 
>>>             "name": null
>>>         }
>>>     }, 
>>>     {
>>>         "body": "voluptates quo voluptatem facilis iure occaecati\nvel assumenda rerum officia et\nillum perspiciatis ab deleniti\nlaudantium repellat ad ut et autem reprehenderit", 
>>>         "post_id": 48, 
>>>         "title": "ut voluptatem illum ea doloribus itaque eos", 
>>>         "user": {
>>>             "email": null, 
>>>             "id": 5, 
>>>             "name": null
>>>         }
>>>     }, 
>>>     {
>>>         "body": "libero voluptate eveniet aperiam sed\nsunt placeat suscipit molestias\nsimilique fugit nam natus\nexpedita consequatur consequatur dolores quia eos et placeat", 
>>>         "post_id": 91, 
>>>        "title": "aut amet sed", 
>>>         "user": {
>>>             "email": null, 
>>>             "id": 10, 
>>>             "name": null
>>>         }
>>>     }
>>> ]
```