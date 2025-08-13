sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant DashboardKaryawanController as DashboardKaryawanController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: GET /resource
    R->>+DashboardKaryawanController: index()
    DashboardKaryawanController->>+KpiScore: all() / get() / paginate()
    KpiScore->>+DB: SELECT * FROM table
    DB-->>-KpiScore: Return records
    KpiScore-->>-DashboardKaryawanController: Collection of models
    DashboardKaryawanController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over DashboardKaryawanController,KpiScore: This sequence retrieves a list of resources
  