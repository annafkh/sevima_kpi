sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiSummaryController as KpiSummaryController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: Request
    R->>+KpiSummaryController: getSemesterDetail()
    Note over KpiSummaryController: Process request
    alt Uses database
      KpiSummaryController->>+KpiScore: operation()
      KpiScore->>+DB: Database query
      DB-->>-KpiScore: Return data
      KpiScore-->>-KpiSummaryController: Return result
    else Direct response
      Note over KpiSummaryController: Process without database
    end
    KpiSummaryController-->>-R: Return response
    R-->>C: Response
    
    Note over KpiSummaryController: Generic operation flow
  