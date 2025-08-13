sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ChartController as ChartController
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: Request
    R->>+ChartController: getChartData()
    Note over ChartController: Process request
    alt Uses database
      ChartController->>+Karyawan: operation()
      Karyawan->>+DB: Database query
      DB-->>-Karyawan: Return data
      Karyawan-->>-ChartController: Return result
    else Direct response
      Note over ChartController: Process without database
    end
    ChartController-->>-R: Return response
    R-->>C: Response
    
    Note over ChartController: Generic operation flow
  