sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KaryawanController as KaryawanController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+KaryawanController: edit(request, id)
    KaryawanController->>+V: validate(request)
    V-->>-KaryawanController: validated data
    KaryawanController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-KaryawanController: Model instance
    KaryawanController->>+Model: update(data)
    Model->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Model: Success
    Model-->>-KaryawanController: Updated model
    KaryawanController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KaryawanController,Model: This sequence updates an existing resource
  