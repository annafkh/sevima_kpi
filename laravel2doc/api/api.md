# API Documentation

## Project: laravel/laravel

Laravel Version: v12.7.2

Generated: 7/10/2025, 12:36:37 PM

## Table of Contents

- [api](#api)
- [web](#web)

## api

| Method | Endpoint | Handler | Description |
|--------|----------|---------|-------------|
| GET | /user | function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 | List user |

### GET /user

**Handler:** function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


**Description:** List user

---

## web

| Method | Endpoint | Handler | Description |
|--------|----------|---------|-------------|
| GET | / | function () {
    return redirect()->route('login');
});
Route::middleware(['auth:sanctum', 'verified' | List resource |
| GET | /dashboard | DashboardController::class, 'index' | List dashboard |
| GET | /chart-data | ChartController::class, 'getChartData' | List chart-data |
| GET | /chart-data/semester | KpiSummaryController::class, 'getSemesterSummary' | List semester |
| GET | /chart-detail/{tahun}/{semester} | ChartController::class, 'chartDetail' | Retrieve a specific {semester} |
| GET | /leader/chart-data/semester | ChartController::class, 'semesterForLeader' | List semester |
| GET | /leader/chart-detail/{tahun}/{semester} | ChartController::class, 'detailForLeader' | Retrieve a specific {semester} |
| GET | /leader/chart-data/semester | ChartController::class, 'semesterForLeader' | List semester |
| DELETE | /kpi_scores/{id} | KpiScoreController::class, 'destroy' | Delete a specific {id} |
| GET | /kpi/summary | KpiSummaryController::class, 'index' | List summary |
| GET | /kpi/summary/{karyawanId}/detail | KpiSummaryController::class, 'show' | Retrieve a specific detail |
| DELETE | /kpi_scores/{id} | KpiSummaryController::class, 'destroy' | Delete a specific {id} |
| GET | /kpi/summary/detail | KpiSummaryController::class, 'summary' | List detail |
| GET | /admin/register-user | AdminUserController::class, 'create' | List register-user |
| POST | /admin/register-user | AdminUserController::class, 'store' | Create a new register-user |
| DELETE | /users/{user} | UserController::class, 'destroy' | Delete a specific {user} |
| DELETE | /users/{user} | UserController::class, 'destroy' | Delete a specific {user} |
| GET | /dashboard/karyawan | DashboardKaryawanController::class, 'index' | List karyawan |

### GET /

**Handler:** function () {
    return redirect()->route('login');
});
Route::middleware(['auth:sanctum', 'verified'

**Description:** List resource

---

### GET /dashboard

**Handler:** DashboardController::class, 'index'

**Description:** List dashboard

---

### GET /chart-data

**Handler:** ChartController::class, 'getChartData'

**Description:** List chart-data

---

### GET /chart-data/semester

**Handler:** KpiSummaryController::class, 'getSemesterSummary'

**Description:** List semester

---

### GET /chart-detail/{tahun}/{semester}

**Handler:** ChartController::class, 'chartDetail'

**Description:** Retrieve a specific {semester}

---

### GET /leader/chart-data/semester

**Handler:** ChartController::class, 'semesterForLeader'

**Description:** List semester

---

### GET /leader/chart-detail/{tahun}/{semester}

**Handler:** ChartController::class, 'detailForLeader'

**Description:** Retrieve a specific {semester}

---

### GET /leader/chart-data/semester

**Handler:** ChartController::class, 'semesterForLeader'

**Description:** List semester

---

### DELETE /kpi_scores/{id}

**Handler:** KpiScoreController::class, 'destroy'

**Description:** Delete a specific {id}

---

### GET /kpi/summary

**Handler:** KpiSummaryController::class, 'index'

**Description:** List summary

---

### GET /kpi/summary/{karyawanId}/detail

**Handler:** KpiSummaryController::class, 'show'

**Description:** Retrieve a specific detail

---

### DELETE /kpi_scores/{id}

**Handler:** KpiSummaryController::class, 'destroy'

**Description:** Delete a specific {id}

---

### GET /kpi/summary/detail

**Handler:** KpiSummaryController::class, 'summary'

**Description:** List detail

---

### GET /admin/register-user

**Handler:** AdminUserController::class, 'create'

**Description:** List register-user

---

### POST /admin/register-user

**Handler:** AdminUserController::class, 'store'

**Description:** Create a new register-user

---

### DELETE /users/{user}

**Handler:** UserController::class, 'destroy'

**Description:** Delete a specific {user}

---

### DELETE /users/{user}

**Handler:** UserController::class, 'destroy'

**Description:** Delete a specific {user}

---

### GET /dashboard/karyawan

**Handler:** DashboardKaryawanController::class, 'index'

**Description:** List karyawan

---

### Resource

| Method | Endpoint | Handler | Description |
|--------|----------|---------|-------------|
| GET | /karyawans | KaryawanController::class@index | List all karyawans |
| GET | /karyawans/create | KaryawanController::class@create | Show form to create a new karyawan |
| POST | /karyawans | KaryawanController::class@store | Store a new karyawan |
| GET | /karyawans/{id} | KaryawanController::class@show | Show a specific karyawan |
| GET | /karyawans/{id}/edit | KaryawanController::class@edit | Show form to edit karyawan |
| PUT/PATCH | /karyawans/{id} | KaryawanController::class@update | Update a specific karyawan |
| DELETE | /karyawans/{id} | KaryawanController::class@destroy | Delete a specific karyawan |
| GET | /kpi_indicators | KpiIndicatorController::class@index | List all kpi_indicators |
| GET | /kpi_indicators/create | KpiIndicatorController::class@create | Show form to create a new kpi_indicator |
| POST | /kpi_indicators | KpiIndicatorController::class@store | Store a new kpi_indicator |
| GET | /kpi_indicators/{id} | KpiIndicatorController::class@show | Show a specific kpi_indicator |
| GET | /kpi_indicators/{id}/edit | KpiIndicatorController::class@edit | Show form to edit kpi_indicator |
| PUT/PATCH | /kpi_indicators/{id} | KpiIndicatorController::class@update | Update a specific kpi_indicator |
| DELETE | /kpi_indicators/{id} | KpiIndicatorController::class@destroy | Delete a specific kpi_indicator |
| GET | /kpi_scores | KpiScoreController::class@index | List all kpi_scores |
| GET | /kpi_scores/create | KpiScoreController::class@create | Show form to create a new kpi_score |
| POST | /kpi_scores | KpiScoreController::class@store | Store a new kpi_score |
| GET | /kpi_scores/{id} | KpiScoreController::class@show | Show a specific kpi_score |
| GET | /kpi_scores/{id}/edit | KpiScoreController::class@edit | Show form to edit kpi_score |
| PUT/PATCH | /kpi_scores/{id} | KpiScoreController::class@update | Update a specific kpi_score |
| DELETE | /kpi_scores/{id} | KpiScoreController::class@destroy | Delete a specific kpi_score |
| GET | /kpi_categories | KpiCategoryController::class@index | List all kpi_categories |
| GET | /kpi_categories/create | KpiCategoryController::class@create | Show form to create a new kpi_categorie |
| POST | /kpi_categories | KpiCategoryController::class@store | Store a new kpi_categorie |
| GET | /kpi_categories/{id} | KpiCategoryController::class@show | Show a specific kpi_categorie |
| GET | /kpi_categories/{id}/edit | KpiCategoryController::class@edit | Show form to edit kpi_categorie |
| PUT/PATCH | /kpi_categories/{id} | KpiCategoryController::class@update | Update a specific kpi_categorie |
| DELETE | /kpi_categories/{id} | KpiCategoryController::class@destroy | Delete a specific kpi_categorie |
| GET | /users | UserController::class@index | List all users |
| GET | /users/create | UserController::class@create | Show form to create a new user |
| POST | /users | UserController::class@store | Store a new user |
| GET | /users/{id} | UserController::class@show | Show a specific user |
| GET | /users/{id}/edit | UserController::class@edit | Show form to edit user |
| PUT/PATCH | /users/{id} | UserController::class@update | Update a specific user |
| DELETE | /users/{id} | UserController::class@destroy | Delete a specific user |
| GET | /users | UserController::class@index | List all users |
| GET | /users/create | UserController::class@create | Show form to create a new user |
| POST | /users | UserController::class@store | Store a new user |
| GET | /users/{id} | UserController::class@show | Show a specific user |
| GET | /users/{id}/edit | UserController::class@edit | Show form to edit user |
| PUT/PATCH | /users/{id} | UserController::class@update | Update a specific user |
| DELETE | /users/{id} | UserController::class@destroy | Delete a specific user |

### GET /karyawans

**Handler:** KaryawanController::class@index

**Description:** List all karyawans

---

### GET /karyawans/create

**Handler:** KaryawanController::class@create

**Description:** Show form to create a new karyawan

---

### POST /karyawans

**Handler:** KaryawanController::class@store

**Description:** Store a new karyawan

---

### GET /karyawans/{id}

**Handler:** KaryawanController::class@show

**Description:** Show a specific karyawan

---

### GET /karyawans/{id}/edit

**Handler:** KaryawanController::class@edit

**Description:** Show form to edit karyawan

---

### PUT/PATCH /karyawans/{id}

**Handler:** KaryawanController::class@update

**Description:** Update a specific karyawan

---

### DELETE /karyawans/{id}

**Handler:** KaryawanController::class@destroy

**Description:** Delete a specific karyawan

---

### GET /kpi_indicators

**Handler:** KpiIndicatorController::class@index

**Description:** List all kpi_indicators

---

### GET /kpi_indicators/create

**Handler:** KpiIndicatorController::class@create

**Description:** Show form to create a new kpi_indicator

---

### POST /kpi_indicators

**Handler:** KpiIndicatorController::class@store

**Description:** Store a new kpi_indicator

---

### GET /kpi_indicators/{id}

**Handler:** KpiIndicatorController::class@show

**Description:** Show a specific kpi_indicator

---

### GET /kpi_indicators/{id}/edit

**Handler:** KpiIndicatorController::class@edit

**Description:** Show form to edit kpi_indicator

---

### PUT/PATCH /kpi_indicators/{id}

**Handler:** KpiIndicatorController::class@update

**Description:** Update a specific kpi_indicator

---

### DELETE /kpi_indicators/{id}

**Handler:** KpiIndicatorController::class@destroy

**Description:** Delete a specific kpi_indicator

---

### GET /kpi_scores

**Handler:** KpiScoreController::class@index

**Description:** List all kpi_scores

---

### GET /kpi_scores/create

**Handler:** KpiScoreController::class@create

**Description:** Show form to create a new kpi_score

---

### POST /kpi_scores

**Handler:** KpiScoreController::class@store

**Description:** Store a new kpi_score

---

### GET /kpi_scores/{id}

**Handler:** KpiScoreController::class@show

**Description:** Show a specific kpi_score

---

### GET /kpi_scores/{id}/edit

**Handler:** KpiScoreController::class@edit

**Description:** Show form to edit kpi_score

---

### PUT/PATCH /kpi_scores/{id}

**Handler:** KpiScoreController::class@update

**Description:** Update a specific kpi_score

---

### DELETE /kpi_scores/{id}

**Handler:** KpiScoreController::class@destroy

**Description:** Delete a specific kpi_score

---

### GET /kpi_categories

**Handler:** KpiCategoryController::class@index

**Description:** List all kpi_categories

---

### GET /kpi_categories/create

**Handler:** KpiCategoryController::class@create

**Description:** Show form to create a new kpi_categorie

---

### POST /kpi_categories

**Handler:** KpiCategoryController::class@store

**Description:** Store a new kpi_categorie

---

### GET /kpi_categories/{id}

**Handler:** KpiCategoryController::class@show

**Description:** Show a specific kpi_categorie

---

### GET /kpi_categories/{id}/edit

**Handler:** KpiCategoryController::class@edit

**Description:** Show form to edit kpi_categorie

---

### PUT/PATCH /kpi_categories/{id}

**Handler:** KpiCategoryController::class@update

**Description:** Update a specific kpi_categorie

---

### DELETE /kpi_categories/{id}

**Handler:** KpiCategoryController::class@destroy

**Description:** Delete a specific kpi_categorie

---

### GET /users

**Handler:** UserController::class@index

**Description:** List all users

---

### GET /users/create

**Handler:** UserController::class@create

**Description:** Show form to create a new user

---

### POST /users

**Handler:** UserController::class@store

**Description:** Store a new user

---

### GET /users/{id}

**Handler:** UserController::class@show

**Description:** Show a specific user

---

### GET /users/{id}/edit

**Handler:** UserController::class@edit

**Description:** Show form to edit user

---

### PUT/PATCH /users/{id}

**Handler:** UserController::class@update

**Description:** Update a specific user

---

### DELETE /users/{id}

**Handler:** UserController::class@destroy

**Description:** Delete a specific user

---

### GET /users

**Handler:** UserController::class@index

**Description:** List all users

---

### GET /users/create

**Handler:** UserController::class@create

**Description:** Show form to create a new user

---

### POST /users

**Handler:** UserController::class@store

**Description:** Store a new user

---

### GET /users/{id}

**Handler:** UserController::class@show

**Description:** Show a specific user

---

### GET /users/{id}/edit

**Handler:** UserController::class@edit

**Description:** Show form to edit user

---

### PUT/PATCH /users/{id}

**Handler:** UserController::class@update

**Description:** Update a specific user

---

### DELETE /users/{id}

**Handler:** UserController::class@destroy

**Description:** Delete a specific user

---

