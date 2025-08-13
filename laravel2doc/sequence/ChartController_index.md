sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ChartController as ChartController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource
    R->>+ChartController: index()
    ChartController->>+Model: all() / get() / paginate()
    Model->>+DB: SELECT * FROM table
    DB-->>-Model: Return records
    Model-->>-ChartController: Collection of models
    ChartController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over ChartController,Model: This sequence retrieves a list of resources
  