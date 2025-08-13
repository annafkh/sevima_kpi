sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KaryawanController as KaryawanController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: POST /resource
    R->>+KaryawanController: create(request)
    KaryawanController->>+V: validate(request)
    V-->>-KaryawanController: validated data
    KaryawanController->>+Model: create(data)
    Model->>+DB: INSERT INTO table
    DB-->>-Model: Return new record
    Model-->>-KaryawanController: New model instance
    KaryawanController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over KaryawanController,Model: This sequence creates a new resource
  