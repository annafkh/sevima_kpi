sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiIndicatorController as KpiIndicatorController
    participant Model as Model
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+KpiIndicatorController: destroy(id)
    KpiIndicatorController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-KpiIndicatorController: Model instance
    KpiIndicatorController->>+Model: delete()
    Model->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Model: Success
    Model-->>-KpiIndicatorController: Success
    KpiIndicatorController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over KpiIndicatorController,Model: This sequence removes a resource
  