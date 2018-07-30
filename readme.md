## Installation 

git clone https://github.com/javedalam86/lucid_crud.git

Create .env from .example.env

Set database connection in env and other required information

run composer update to generate library files

run php artisan migrate 

run  php artisan passport:install

## CRUD

Create user

http://<domain>/api/v1/users/create  with POST

request: 

{
	"name":"Naved G",
	"email":"javedalam8335@gmail.com",
	"password":"123456",
	"password_confirmation":"123456"
}

Response:

{
    "status": "SUCCESS",
    "code": 200,
    "response": "user added successfully"
}

Show User

http://<domain>/api/v1/users/view/1   With GET

Rsponse : 

{
    "status": "SUCCESS",
    "code": 200,
    "response": {
        "id": 4,
        "name": "Naved G",
        "email": "javedalam855@gmail.com",
        "created_at": "2018-06-14 05:53:23",
        "updated_at": "2018-06-14 05:53:23"
    }
}

List User 

http://<domain>/api/v1/users  With GET

{
    "status": "SUCCESS",
    "code": 200,
    "response": [
        {
            "id": 1,
            "name": "Javed",
            "email": "javedalam86@gmail.com",
            "created_at": "2018-06-14 05:28:10",
            "updated_at": "2018-06-14 05:50:40"
        }
    ]
}

Update User

http://<domain>/api/v1/users/1/update  with PUT method

Request : 

{
	"name":"Javed",
	"email":"javedalam8666@gmail.com",
	"password":"123456"
}

Response :

{
    "status": "SUCCESS",
    "code": 200,
    "response": "user update successfully"
}
## Lucid

The Lucid Architecture is a software architecture that consolidates code-base maintenance as the application scales,
from becoming overwhelming to handle, gets us rid of rotting code that will later become legacy code, and translate
the day-to-day language such as Feature and Service into actual, physical code.

Read more about the [Lucid Architecture Concept](https://medium.com/vine-lab/the-lucid-architecture-concept-ad8e9ed0258f).

If you prefer a video, watch the announcement of The Lucid Architecture at LaraconEU 2016:

##### The Lucid Architecture for Building Scalable Applications - Laracon EU 2016
[![Abed Halawi - The Lucid Architecture for Building Scalable Applications](http://img.youtube.com/vi/wSnM4JkyxPw/0.jpg)](http://www.youtube.com/watch?v=wSnM4JkyxPw "Abed Halawi - The Lucid Architecture for Building Scalable Applications")

