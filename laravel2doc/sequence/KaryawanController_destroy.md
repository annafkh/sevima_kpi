sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KaryawanController as KaryawanController
    participant Model as Model
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+KaryawanController: destroy(id)
    KaryawanController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-KaryawanController: Model instance
    KaryawanController->>+Model: delete()
    Model->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Model: Success
    Model-->>-KaryawanController: Success
    KaryawanController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over KaryawanController,Model: This sequence removes a resource
  