sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KaryawanController as KaryawanController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource/{id}
    R->>+KaryawanController: show(id)
    KaryawanController->>+Model: find(id) / findOrFail(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-KaryawanController: Model instance
    KaryawanController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KaryawanController,Model: This sequence retrieves a specific resource by ID
  