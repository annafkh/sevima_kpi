sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiIndicatorController as KpiIndicatorController
    participant KpiCategory as KpiCategory
    participant DB as Database
    
    C->>R: GET /resource
    R->>+KpiIndicatorController: index()
    KpiIndicatorController->>+KpiCategory: all() / get() / paginate()
    KpiCategory->>+DB: SELECT * FROM table
    DB-->>-KpiCategory: Return records
    KpiCategory-->>-KpiIndicatorController: Collection of models
    KpiIndicatorController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiIndicatorController,KpiCategory: This sequence retrieves a list of resources
  