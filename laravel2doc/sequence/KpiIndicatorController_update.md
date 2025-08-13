sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiIndicatorController as KpiIndicatorController
    participant V as Validator
    participant KpiIndicator as KpiIndicator
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+KpiIndicatorController: update(request, id)
    KpiIndicatorController->>+V: validate(request)
    V-->>-KpiIndicatorController: validated data
    KpiIndicatorController->>+KpiIndicator: find(id)
    KpiIndicator->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-KpiIndicator: Return record
    KpiIndicator-->>-KpiIndicatorController: Model instance
    KpiIndicatorController->>+KpiIndicator: update(data)
    KpiIndicator->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-KpiIndicator: Success
    KpiIndicator-->>-KpiIndicatorController: Updated model
    KpiIndicatorController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiIndicatorController,KpiIndicator: This sequence updates an existing resource
  