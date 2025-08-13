sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource/{id}
    R->>+KpiScoreController: show(id)
    KpiScoreController->>+Model: find(id) / findOrFail(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-KpiScoreController: Model instance
    KpiScoreController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiScoreController,Model: This sequence retrieves a specific resource by ID
  