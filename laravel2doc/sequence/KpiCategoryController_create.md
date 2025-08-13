sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiCategoryController as KpiCategoryController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: POST /resource
    R->>+KpiCategoryController: create(request)
    KpiCategoryController->>+V: validate(request)
    V-->>-KpiCategoryController: validated data
    KpiCategoryController->>+Model: create(data)
    Model->>+DB: INSERT INTO table
    DB-->>-Model: Return new record
    Model-->>-KpiCategoryController: New model instance
    KpiCategoryController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over KpiCategoryController,Model: This sequence creates a new resource
  