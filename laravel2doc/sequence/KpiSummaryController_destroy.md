sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiSummaryController as KpiSummaryController
    participant KpiScore as KpiScore
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+KpiSummaryController: destroy(id)
    KpiSummaryController->>+KpiScore: find(id)
    KpiScore->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-KpiScore: Return record
    KpiScore-->>-KpiSummaryController: Model instance
    KpiSummaryController->>+KpiScore: delete()
    KpiScore->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-KpiScore: Success
    KpiScore-->>-KpiSummaryController: Success
    KpiSummaryController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over KpiSummaryController,KpiScore: This sequence removes a resource
  