sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiIndicatorController as KpiIndicatorController
    participant V as Validator
    participant KpiIndicator as KpiIndicator
    participant DB as Database
    
    C->>R: POST /resource
    R->>+KpiIndicatorController: store(request)
    KpiIndicatorController->>+V: validate(request)
    V-->>-KpiIndicatorController: validated data
    KpiIndicatorController->>+KpiIndicator: create(data)
    KpiIndicator->>+DB: INSERT INTO table
    DB-->>-KpiIndicator: Return new record
    KpiIndicator-->>-KpiIndicatorController: New model instance
    KpiIndicatorController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over KpiIndicatorController,KpiIndicator: This sequence creates a new resource
  