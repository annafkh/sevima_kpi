sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant UserController as UserController
    participant Model as Model
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+UserController: destroy(id)
    UserController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-UserController: Model instance
    UserController->>+Model: delete()
    Model->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Model: Success
    Model-->>-UserController: Success
    UserController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over UserController,Model: This sequence removes a resource
  