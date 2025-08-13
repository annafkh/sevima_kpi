erDiagram
  karyawan {
    int id PK "Primary key"
    string nama
    string ktp
    string jabatan
    string nohp
    string jk
    int karyawan_id FK "References karyawan"
    int kpi_indicator_id FK "References kpi_indicator"
    int leader_user_id FK "References leader_user"
    datetime created_at
    datetime updated_at
  }
  kpicategory {
    int id PK "Primary key"
    string nama
    string deskripsi
    int kategori_id FK "References kategori"
    datetime created_at
    datetime updated_at
  }
  kpiindicator {
    int id PK "Primary key"
    string nama
    string bobot
    string target
    int kpi_category_id FK "References kpi_category"
    string deskripsi
    string status
    int kpi_categori_id FK "References kpicategory"
    int kategori_id FK "References kategori"
    datetime created_at
    datetime updated_at
  }
  kpiscore {
    int id PK "Primary key"
    int karyawan_id FK "References karyawan"
    int kpi_indicator_id FK "References kpiindicator"
    string nilai
    string tanggal
    int kpiindicator_id FK "References kpiindicator"
    int user_id FK "References user"
    datetime created_at
    datetime updated_at
  }
  kpisummary {
    int id PK "Primary key"
    int karyawan_id FK "References karyawan"
    float total_nilai
    datetime created_at
    datetime updated_at
  }
  user {
    int id PK "Primary key"
    string name
    string email
    string password
    string role
    int user_id FK "References user"
    int leader_user_id FK "References leader_user"
    int karyawan_id FK "References karyawan"
    datetime created_at
    datetime updated_at
  }
  karyawan ||--o| user : "user"
  karyawan ||--|{ kpiscore : "kpiScores"
  karyawan }|--|{ user : "leaders"
  kpicategory ||--|{ kpiindicator : "indicators"
  kpiindicator }|--|| kpicategory : "kategori"
  kpiscore }|--|| karyawan : "karyawan"
  kpiscore }|--|| kpiindicator : "kpiIndicator"
  kpiscore }|--|| kpiindicator : "indicator"
  kpiscore }|--|| user : "user"
  kpisummary }|--|| karyawan : "karyawan"
  user ||--o| karyawan : "karyawan"
  user ||--|{ kpiscore : "kpiScores"
