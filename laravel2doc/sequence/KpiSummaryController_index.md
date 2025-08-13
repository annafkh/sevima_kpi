sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiSummaryController as KpiSummaryController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource
    R->>+KpiSummaryController: index()
    KpiSummaryController->>+Model: all() / get() / paginate()
    Model->>+DB: SELECT * FROM table
    DB-->>-Model: Return records
    Model-->>-KpiSummaryController: Collection of models
    KpiSummaryController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiSummaryController,Model: This sequence retrieves a list of resources
  