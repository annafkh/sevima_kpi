sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KpiScoreController as KpiScoreController
    participant V as Validator
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+KpiScoreController: edit(request, id)
    KpiScoreController->>+V: validate(request)
    V-->>-KpiScoreController: validated data
    KpiScoreController->>+Karyawan: find(id)
    Karyawan->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Karyawan: Return record
    Karyawan-->>-KpiScoreController: Model instance
    KpiScoreController->>+Karyawan: update(data)
    Karyawan->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Karyawan: Success
    Karyawan-->>-KpiScoreController: Updated model
    KpiScoreController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KpiScoreController,Karyawan: This sequence updates an existing resource
  