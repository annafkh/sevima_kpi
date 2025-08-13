sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant KaryawanController as KaryawanController
    participant Karyawan as Karyawan
    participant DB as Database
    
    C->>R: GET /resource
    R->>+KaryawanController: index()
    KaryawanController->>+Karyawan: all() / get() / paginate()
    Karyawan->>+DB: SELECT * FROM table
    DB-->>-Karyawan: Return records
    Karyawan-->>-KaryawanController: Collection of models
    KaryawanController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over KaryawanController,Karyawan: This sequence retrieves a list of resources
  