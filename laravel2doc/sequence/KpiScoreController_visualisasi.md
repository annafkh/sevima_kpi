sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: Request
    R->>+KpiScoreController: visualisasi()
    Note over KpiScoreController: Process request
    alt Uses database
      KpiScoreController->>+KpiScore: operation()
      KpiScore->>+DB: Database query
      DB-->>-KpiScore: Return data
      KpiScore-->>-KpiScoreController: Return result
    else Direct response
      Note over KpiScoreController: Process without database
    end
    KpiScoreController-->>-R: Return response
    R-->>C: Response
    
    Note over KpiScoreController: Generic operation flow
  