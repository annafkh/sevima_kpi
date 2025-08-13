sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiIndicatorController as KpiIndicatorController
    participant V as Validator
    participant KpiCategory as KpiCategory
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+KpiIndicatorController: edit(request, id)
    KpiIndicatorController->>+V: validate(request)
    V-->>-KpiIndicatorController: validated data
    KpiIndicatorController->>+KpiCategory: find(id)
    KpiCategory->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-KpiCategory: Return record
    KpiCategory-->>-KpiIndicatorController: Model instance
    KpiIndicatorController->>+KpiCategory: update(data)
    KpiCategory->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-KpiCategory: Success
    KpiCategory-->>-KpiIndicatorController: Updated model
    KpiIndicatorController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiIndicatorController,KpiCategory: This sequence updates an existing resource
  