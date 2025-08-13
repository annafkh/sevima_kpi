sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant AdminUserController as AdminUserController
    participant V as Validator
    participant User as User
    participant DB as Database
    
    C->>R: POST /resource
    R->>+AdminUserController: store(request)
    AdminUserController->>+V: validate(request)
    V-->>-AdminUserController: validated data
    AdminUserController->>+User: create(data)
    User->>+DB: INSERT INTO table
    DB-->>-User: Return new record
    User-->>-AdminUserController: New model instance
    AdminUserController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over AdminUserController,User: This sequence creates a new resource
  