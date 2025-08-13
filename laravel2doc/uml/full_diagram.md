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
  class AdminUserController {
    <<Controller>>
    +create()
    +store(Request $request)
  }
  class ChartController {
    <<Controller>>
    +index()
    +getChartData(Request $request)
    +chartDetail($tahun, $semester)
    +semesterForLeader()
    +detailForLeader($tahun, $semester)
  }
  class Controller {
    <<Controller>>
  }
  class DashboardController {
    <<Controller>>
    +index(Request $request)
  }
  class DashboardKaryawanController {
    <<Controller>>
    +index()
  }
  class EvaluationController {
    <<Controller>>
    +index()
  }
  class KaryawanController {
    <<Controller>>
    +index()
    +create()
    +store(Request $request)
    +show(string $id)
    +edit(Karyawan $karyawan)
    +update(Request $request, Karyawan $karyawan)
    +destroy(Karyawan $karyawan)
  }
  class KpiCategoryController {
    <<Controller>>
    +index()
    +create()
    +store(Request $request)
    +edit($id)
    +update(Request $request, $id)
    +destroy(KpiCategory $kpiCategory)
  }
  class KpiIndicatorController {
    <<Controller>>
    +index()
    +create()
    +store(Request $request)
    +edit($id)
    +update(Request $request, $id)
    +destroy(KpiIndicator $kpi_indicator)
  }
  class KpiScoreController {
    <<Controller>>
    +index()
    +visualisasi()
    +create()
    +create(Request $request)
    +edit($id)
    +store(Request $request)
    +store(Request $request)
    +show(string $id)
    +update(Request $request, $id)
    +destroy($id)
  }
  class KpiSummaryController {
    <<Controller>>
    +index(Request $request)
    +show(Request $request, $karyawanId)
    +summary(Request $request)
    +destroy($id)
    +getSemesterSummary(Request $request)
    +getSemesterDetail($tahun, $semester)
  }
  class UserController {
    <<Controller>>
    +index()
    +create()
    +edit(User $user)
    +update(Request $request, User $user)
    +store(Request $request)
    +destroy(User $user)
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
