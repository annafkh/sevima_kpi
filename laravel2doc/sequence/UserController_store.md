sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant UserController as UserController
    participant V as Validator
    participant User as User
    participant DB as Database
    
    C->>R: POST /resource
    R->>+UserController: store(request)
    UserController->>+V: validate(request)
    V-->>-UserController: validated data
    UserController->>+User: create(data)
    User->>+DB: INSERT INTO table
    DB-->>-User: Return new record
    User-->>-UserController: New model instance
    UserController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over UserController,User: This sequence creates a new resource
  