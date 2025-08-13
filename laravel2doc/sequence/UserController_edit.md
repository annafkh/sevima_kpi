sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant UserController as UserController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+UserController: edit(request, id)
    UserController->>+V: validate(request)
    V-->>-UserController: validated data
    UserController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-UserController: Model instance
    UserController->>+Model: update(data)
    Model->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Model: Success
    Model-->>-UserController: Updated model
    UserController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over UserController,Model: This sequence updates an existing resource
  