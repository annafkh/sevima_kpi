sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant UserController as UserController
    participant User as User
    participant DB as Database
    
    C->>R: GET /resource
    R->>+UserController: index()
    UserController->>+User: all() / get() / paginate()
    User->>+DB: SELECT * FROM table
    DB-->>-User: Return records
    User-->>-UserController: Collection of models
    UserController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over UserController,User: This sequence retrieves a list of resources
  