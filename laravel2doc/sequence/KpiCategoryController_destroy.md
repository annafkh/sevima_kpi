sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiCategoryController as KpiCategoryController
    participant Model as Model
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+KpiCategoryController: destroy(id)
    KpiCategoryController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-KpiCategoryController: Model instance
    KpiCategoryController->>+Model: delete()
    Model->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Model: Success
    Model-->>-KpiCategoryController: Success
    KpiCategoryController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over KpiCategoryController,Model: This sequence removes a resource
  