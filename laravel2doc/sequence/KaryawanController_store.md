sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KaryawanController as KaryawanController
    participant V as Validator
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: POST /resource
    R->>+KaryawanController: store(request)
    KaryawanController->>+V: validate(request)
    V-->>-KaryawanController: validated data
    KaryawanController->>+Karyawan: create(data)
    Karyawan->>+DB: INSERT INTO table
    DB-->>-Karyawan: Return new record
    Karyawan-->>-KaryawanController: New model instance
    KaryawanController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over KaryawanController,Karyawan: This sequence creates a new resource
  