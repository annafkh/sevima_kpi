sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiIndicatorController as KpiIndicatorController
    participant V as Validator
    participant KpiCategory as KpiCategory
    participant DB as Database
    
    C->>R: POST /resource
    R->>+KpiIndicatorController: create(request)
    KpiIndicatorController->>+V: validate(request)
    V-->>-KpiIndicatorController: validated data
    KpiIndicatorController->>+KpiCategory: create(data)
    KpiCategory->>+DB: INSERT INTO table
    DB-->>-KpiCategory: Return new record
    KpiCategory-->>-KpiIndicatorController: New model instance
    KpiIndicatorController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over KpiIndicatorController,KpiCategory: This sequence creates a new resource
  