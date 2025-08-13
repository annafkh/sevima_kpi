sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant AdminUserController as AdminUserController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: POST /resource
    R->>+AdminUserController: create(request)
    AdminUserController->>+V: validate(request)
    V-->>-AdminUserController: validated data
    AdminUserController->>+Model: create(data)
    Model->>+DB: INSERT INTO table
    DB-->>-Model: Return new record
    Model-->>-AdminUserController: New model instance
    AdminUserController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over AdminUserController,Model: This sequence creates a new resource
  