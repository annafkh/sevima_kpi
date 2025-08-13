sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ChartController as ChartController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: Request
    R->>+ChartController: detailForLeader()
    Note over ChartController: Process request
    alt Uses database
      ChartController->>+KpiScore: operation()
      KpiScore->>+DB: Database query
      DB-->>-KpiScore: Return data
      KpiScore-->>-ChartController: Return result
    else Direct response
      Note over ChartController: Process without database
    end
    ChartController-->>-R: Return response
    R-->>C: Response
    
    Note over ChartController: Generic operation flow
  