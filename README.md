
# API Documentation

## Table of Contents
- [Introduction](#introduction)
- [Authentication](#authentication)
- [Error Handling](#error-handling)
- [Endpoints](#endpoints)
  - [1. User Login](#1-user-login)
  - [2. User Registration](#2-user-registration)
  - [3. Get User ](#3-get-user)
  - [4. Get User Details](#4-get-user-details)
  - [5. Add User](#5-add-user)
  - [6. Update User Information](#6-update-user-information)
  - [7. Delete User](#7-delete-user)
- [Response Codes](#response-codes)

---

## Introduction
Selamat datang di Dlabs API. API ini dibuat sebagai tes.

## Authentication
Semua akses terautentikasi menggunakan token JWT. Silakan login dengan akun yang valid.

- **Header**: `Authorization: Bearer {token}`

## Error Handling
API menggunakan standard HTTP status codes untuk menunjukkan sukses atau kesalahan permintaan. Respon terdiri dari sebuah `message` jika terdapat error.

Example:
```json
{
  "message": "Invalid token"
}
```

---

## Endpoints

### 1. User Login

- **URL**: `/api/login`
- **Method**: `POST`
- **Description**: Authenticates the user and returns a JWT token.
  
#### Request
- **Headers**: None
- **Body Parameters**:
  - `email` (string, required): The user's email address.
  - `password` (string, required): The user's password.

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

#### Response
- **Success (200)**:
  ```json
  {
    "token": "jwt_token_here"
  }
  ```

- **Failure (401)**:
  ```json
  {
    "message": "Invalid credentials"
  }
  ```

---

### 2. User Registration

- **URL**: `/api/register`
- **Method**: `POST`
- **Description**: Registers a new user and returns their profile information.

#### Request
- **Headers**: None
- **Body Parameters**:
  - `name` (string, required): The user's full name.
  - `email` (string, required): The user's email address.
  - `password` (string, required): The user's password.
  - `age` (integer, required): The user's age.

#### Response
- **Success (201)**:
  ```json
  {
    "data": {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "age": 30,
      "created_at" : "2022-01-01T00:00:00.000000Z",
      "updated_at" : "2022-01-01T00:00:00.000000Z"
    },
    "token": "jwt_token_here"
  }
  ```

---

### 3. Get User

- **URL**: `/api/user`
- **Method**: `GET`
- **Description**: Returns all user data.
- **Headers**:
  - `Authorization: Bearer {token}`

#### Response
- **Success (200)**:
  ```json
  {
    "message": "Sukses mendapatkan data",
    "user": [{
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "age": 30,
      "created_at" : "2022-01-01T00:00:00.000000Z",
      "updated_at" : "2022-01-01T00:00:00.000000Z"
    }, ...]
  }
  ```

---

### 4. Get User Details

- **URL**: `/api/user/{id}`
- **Method**: `GET`
- **Description**: Returns the user with the specified ID.
- **Headers**:
  - `Authorization: Bearer {token}`

#### Response
- **Success (200)**:
  ```json
  {
    "message" : "Sukses mendapatkan data",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "age": 30,
      "created_at" : "2022-01-01T00:00:00.000000Z",
      "updated_at" : "2022-01-01T00:00:00.000000Z"
    }
  }

---

### 5. Add User

- **URL**: `/api/user`
- **Method**: `POST`
- **Description**: Adds a new user.
- **Headers**:
  - `Authorization: Bearer {token}`

#### Request
- **Body Parameters**:
  - `name` (string, required): The name of the user.
  - `email` (string, required): The email of the user.
  - `password` (string, required): The password of the user.
  - `age` (integer, required): The age of the user.

#### Response
- **Success (201)**:
  ```json
  {
    "message": "User berhasil ditambahkan",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "age": 30,
      "created_at" : "2022-01-01T00:00:00.000000Z",
      "updated_at" : "2022-01-01T00:00:00.000000Z"
    }
  }
---

### 6. Update User Information

- **URL**: `/api/user/{id}`
- **Method**: `PUT`
- **Description**: Updates user information.
- **Headers**:
  - `Authorization: Bearer {token}`

#### Request
- **Body Parameters**:
  - `name` (string, required): The new name of the user.
  - `email` (string, required): The new email of the user.
  - `password` (string, optional): The new password of the user.
  - `age` (integer, required): The new age of the user.

#### Response
- **Success (200)**:
  ```json
  {
    "message": "User berhasil diperbarui",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "age": 30,
      "created_at" : "2022-01-01T00:00:00.000000Z",
      "updated_at" : "2022-01-01T00:00:00.000000Z"
    }
  }
  ```

---

### 7. Delete User

- **URL**: `/api/user/{id}`
- **Method**: `DELETE`
- **Description**: Deletes the user with the specified ID.
- **Headers**:
  - `Authorization: Bearer {token}`

#### Response
- **Success (200)**:
  ```json
  {
    "message": "User berhasil di hapus"
  }

## Response Codes

| Status Code | Description                   |
|-------------|-------------------------------|
| 200         | OK - Successful Request       |
| 201         | Created - Resource Created    |
| 400         | Bad Request - Validation Error|
| 401         | Unauthorized - Invalid Token  |
| 403         | Forbidden - Access Denied     |
| 404         | Not Found - Resource Not Found|
| 500         | Internal Server Error         |

---
