sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiCategoryController as KpiCategoryController
    participant KpiCategory as KpiCategory
    participant DB as Database
    
    C->>R: GET /resource
    R->>+KpiCategoryController: index()
    KpiCategoryController->>+KpiCategory: all() / get() / paginate()
    KpiCategory->>+DB: SELECT * FROM table
    DB-->>-KpiCategory: Return records
    KpiCategory-->>-KpiCategoryController: Collection of models
    KpiCategoryController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiCategoryController,KpiCategory: This sequence retrieves a list of resources
  