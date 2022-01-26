<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300"></a></p>

## About the Project
Basic Laravel API project build for educational purposes in Siliconmade Academy's Advanced Full-Stack Course. 
- User Register, login, token refresh, logout

## Features
- [JWT Authentication](https://jwt-auth.readthedocs.io/en/develop/) system with bearer token
- 'Repository Pattern' as a layer abstraction implemented instead of Laravel's default 'Active Record Pattern'

## Installing Project
- Clone the git repository: `git clone git@github.com:furkanmeraloglu/sf001-api.git`
- Modify the `.env` file configure your database settings.
- Install project dependencies with `composer install` and update if necessary `composer update`
- Attach a fresh application key to the project with `php artisan key:generate`
- Generate the secret JWT key for initial auth token `php artisan jwt:secret`
- Run the migrations and seed the database `php artisan migrate`

## API Documentation
### Resource Description and API Endpoints

`Base URL: "YOUR_LOCALHOST_URL"/api`

### User Register

		POST				/auth/register

***Body Form-Data Parameters***

| Key | Type | Value |
| ----------- | ----------- | ---------|
| name |string | Furkan Meraloğlu |
| email |email | furkanmeraloglu@gmail.com |
| password |password | furkanmeraloglu | 
| password_confirmation |password | furkanmeraloglu |

Example: `"YOUR_LOCALHOST_URL"/auth/register`

```json
{
    "message": "Agent successfully registered",
    "user": {
        "name": "Furkan Meraloğlu",
        "email": "furkanmeraloglu@gmail.com",
        "updated_at": "2021-12-07T00:36:54.000000Z",
        "created_at": "2021-12-07T00:36:54.000000Z",
        "id": 6
    }
}
```

### User Login

    	POST				/auth/login
***Body Form-Data Parameters***

| Key | Type | Value |
| ----------- | ----------- | ---------- | 
| email |email | furkanmeraloglu@gmail.com |
| password |password | furkanmeraloglu |

Example: `"YOUR_LOCALHOST_URL"/auth/login`

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2Mzg4MzgwMTAsImV4cCI6MTYzODg0MTYxMCwibmJmIjoxNjM4ODM4MDEwLCJqdGkiOiJNV0V1QU83WVFmWlpqYXUwIiwic3ViIjo2LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.2cc8MqoWk7cnNzqu0Fqrfx1moibwAuQbqwC45QuvObQ",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 6,
        "name": "Furkan Meraloğlu",
        "email": "furkanmeraloglu@gmail.com",
        "email_verified_at": "2021-12-07T00:36:26.000000Z",
        "is_admin": 0,
        "created_at": "2021-12-07T00:36:54.000000Z",
        "updated_at": "2021-12-07T00:36:54.000000Z"
    }
}
```

### User Token Refresh

    	POST				/auth/refresh

Example: `"YOUR_LOCALHOST_URL"/auth/refresh`

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aFwvcmVmcmVzaCIsImlhdCI6MTYzODgzODAxMCwiZXhwIjoxNjM4ODQxNjYxLCJuYmYiOjE2Mzg4MzgwNjEsImp0aSI6Ik5VU3BTWGVpVklMNmJlTHoiLCJzdWIiOjYsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UHvUB4yYdcqNHhz8jNqMqt4e6WsjE4Uywugs9ixGu2g",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 6,
        "name": "Furkan Meraloğlu",
        "email": "furkanmeraloglu@gmail.com",
        "email_verified_at": "2021-12-07T00:36:26.000000Z",
        "is_admin": 0,
        "created_at": "2021-12-07T00:36:54.000000Z",
        "updated_at": "2021-12-07T00:36:54.000000Z"
    }
}
```

### User Logout
		POST				/auth/logout

Example: `"YOUR_LOCALHOST_URL"/auth/logout`

```json
{
    "message": "User successfully signed out"
}
```

### User Information
		GET					/auth/user-profile

Example: `"YOUR_LOCALHOST_URL"/auth/user-profile`

```json
{
    "id": 6,
    "name": "Furkan Meraloğlu",
    "email": "furkanmeraloglu@gmail.com",
    "email_verified_at": "2021-12-07T00:36:26.000000Z",
    "is_admin": 0,
    "created_at": "2021-12-07T00:36:54.000000Z",
    "updated_at": "2021-12-07T00:36:54.000000Z"
}
```
