sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant V as Validator
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: POST /resource
    R->>+KpiScoreController: store(request)
    KpiScoreController->>+V: validate(request)
    V-->>-KpiScoreController: validated data
    KpiScoreController->>+Karyawan: create(data)
    Karyawan->>+DB: INSERT INTO table
    DB-->>-Karyawan: Return new record
    Karyawan-->>-KpiScoreController: New model instance
    KpiScoreController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over KpiScoreController,Karyawan: This sequence creates a new resource
  