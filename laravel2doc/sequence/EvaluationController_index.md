sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant EvaluationController as EvaluationController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource
    R->>+EvaluationController: index()
    EvaluationController->>+Model: all() / get() / paginate()
    Model->>+DB: SELECT * FROM table
    DB-->>-Model: Return records
    Model-->>-EvaluationController: Collection of models
    EvaluationController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over EvaluationController,Model: This sequence retrieves a list of resources
  