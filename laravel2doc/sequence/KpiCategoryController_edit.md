sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiCategoryController as KpiCategoryController
    participant V as Validator
    participant KpiCategory as KpiCategory
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+KpiCategoryController: edit(request, id)
    KpiCategoryController->>+V: validate(request)
    V-->>-KpiCategoryController: validated data
    KpiCategoryController->>+KpiCategory: find(id)
    KpiCategory->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-KpiCategory: Return record
    KpiCategory-->>-KpiCategoryController: Model instance
    KpiCategoryController->>+KpiCategory: update(data)
    KpiCategory->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-KpiCategory: Success
    KpiCategory-->>-KpiCategoryController: Updated model
    KpiCategoryController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiCategoryController,KpiCategory: This sequence updates an existing resource
  