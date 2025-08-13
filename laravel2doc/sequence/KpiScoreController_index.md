sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: GET /resource
    R->>+KpiScoreController: index()
    KpiScoreController->>+Karyawan: all() / get() / paginate()
    Karyawan->>+DB: SELECT * FROM table
    DB-->>-Karyawan: Return records
    Karyawan-->>-KpiScoreController: Collection of models
    KpiScoreController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiScoreController,Karyawan: This sequence retrieves a list of resources
  