sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant DashboardController as DashboardController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: GET /resource
    R->>+DashboardController: index()
    DashboardController->>+KpiScore: all() / get() / paginate()
    KpiScore->>+DB: SELECT * FROM table
    DB-->>-KpiScore: Return records
    KpiScore-->>-DashboardController: Collection of models
    DashboardController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over DashboardController,KpiScore: This sequence retrieves a list of resources
  