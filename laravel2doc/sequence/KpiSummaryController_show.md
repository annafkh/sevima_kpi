sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiSummaryController as KpiSummaryController
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: GET /resource/{id}
    R->>+KpiSummaryController: show(id)
    KpiSummaryController->>+Karyawan: find(id) / findOrFail(id)
    Karyawan->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Karyawan: Return record
    Karyawan-->>-KpiSummaryController: Model instance
    KpiSummaryController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiSummaryController,Karyawan: This sequence retrieves a specific resource by ID
  