sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ChartController as ChartController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+ChartController: chartDetail()
    Note over ChartController: Process request
    alt Uses database
      ChartController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-ChartController: Return result
    else Direct response
      Note over ChartController: Process without database
    end
    ChartController-->>-R: Return response
    R-->>C: Response
    
    Note over ChartController: Generic operation flow
  