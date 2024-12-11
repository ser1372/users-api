# API Endpoints

## Authentication

### Login
- **Endpoint**: `/api/login_check`
- **Method**: `POST`
- **Description**: Authenticates a user and provides a JWT token.
- **Request Body**:
  ```json
  {
      "login": "user@example.com",
      "pass": "password123"
  }
  ```
- **Response**:
  ```json
  {
      "token": "your_jwt_token",
      "refresh_token": "your_refresh_token"
  }
  ```

---

## User Management

### Create a User
- **Endpoint**: `/v1/api/users`
- **Method**: `POST`
- **Description**: Creates a new user.
- **Request Body**:
  ```json
  {
      "login": "12345678",
      "pass": "test",
      "phone": "12345678"
  }
  ```
- **Response**:
  ```json
  {
      "id": 1,
      "login": "12345678",
      "pass": "test",
      "phone": "12345678"
      "status": 201
  }
  ```

### Update a User
- **Endpoint**: `/v1/api/users/{id}`
- **Method**: `PUT`
- **Description**: Updates an existing user.
- **Request Body**:
  ```json
  {
      "id": "123",
  }
  ```
- **Response**:
  ```json
  {
      "id": 1,
      "login": "updateduser",
      "phone": "12345"
  }
  ```


### Get a User
- **Endpoint**: `/v1/api/users/{id}`
- **Method**: `GET`
- **Description**: Get an existing user.

- **Response**:
```json
{
    "login": "updateduser",
    "phone": "123456",
    "pass": "qweqasd123123"
}
```

### Delete a User
- **Endpoint**: `/v1/api/users/{id}`
- **Method**: `DELETE`
- **Description**: Deletes an existing user.
- **Response**:
  ```json
  {}
  ```
