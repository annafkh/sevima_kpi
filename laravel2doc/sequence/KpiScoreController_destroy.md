sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+KpiScoreController: destroy(id)
    KpiScoreController->>+KpiScore: find(id)
    KpiScore->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-KpiScore: Return record
    KpiScore-->>-KpiScoreController: Model instance
    KpiScoreController->>+KpiScore: delete()
    KpiScore->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-KpiScore: Success
    KpiScore-->>-KpiScoreController: Success
    KpiScoreController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over KpiScoreController,KpiScore: This sequence removes a resource
  