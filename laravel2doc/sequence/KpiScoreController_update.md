sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant V as Validator
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+KpiScoreController: update(request, id)
    KpiScoreController->>+V: validate(request)
    V-->>-KpiScoreController: validated data
    KpiScoreController->>+KpiScore: find(id)
    KpiScore->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-KpiScore: Return record
    KpiScore-->>-KpiScoreController: Model instance
    KpiScoreController->>+KpiScore: update(data)
    KpiScore->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-KpiScore: Success
    KpiScore-->>-KpiScoreController: Updated model
    KpiScoreController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiScoreController,KpiScore: This sequence updates an existing resource
  