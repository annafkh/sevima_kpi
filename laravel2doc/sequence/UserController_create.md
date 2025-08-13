sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant UserController as UserController
    participant V as Validator
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: POST /resource
    R->>+UserController: create(request)
    UserController->>+V: validate(request)
    V-->>-UserController: validated data
    UserController->>+Karyawan: create(data)
    Karyawan->>+DB: INSERT INTO table
    DB-->>-Karyawan: Return new record
    Karyawan-->>-UserController: New model instance
    UserController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over UserController,Karyawan: This sequence creates a new resource
  