classDiagram
  class Karyawan {
    <<Table: karyawans>>
    +nama
    +ktp
    +jabatan
    +nohp
    +jk
  }
  class KpiCategory {
    +nama
    +deskripsi
  }
  class KpiIndicator {
    +nama
    +bobot
    +target
    +kpi_category_id
    +deskripsi
    +status
  }
  class KpiScore {
    +karyawan_id
    +kpi_indicator_id
    +nilai
    +tanggal
  }
  class KpiSummary {
    <<Table: kpi_summaries>>
    +karyawan_id
    +total_nilai
  }
  class LeaderKaryawan {
  }
  class User {
    +name
    +email
    +password
    +role
  }
  Karyawan --> User : user
  Karyawan --* KpiScore : kpiscores
  Karyawan <--* User : leaders
  KpiCategory --* KpiIndicator : indicators
  KpiIndicator <-- KpiCategory : kategori
  KpiScore <-- Karyawan : karyawan
  KpiScore <-- KpiIndicator : kpiindicator
  KpiScore <-- KpiIndicator : indicator
  KpiScore <-- User : user
  KpiSummary <-- Karyawan : karyawan
  User --> Karyawan : karyawan
  User --* KpiScore : kpiscores
