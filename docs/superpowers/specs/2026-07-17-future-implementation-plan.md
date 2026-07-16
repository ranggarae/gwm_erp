# Future Implementation Plan: 4 Missing Core Modules

> **For agentic workers (TARNO):** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.
>
> 🛑 **CRITICAL INSTRUCTION FOR TARNO:**
> **Ooy TARNO!!! kerjain per module (fitur) satu-satu. kalo satu module selesai, test running dulu fiturnya udah jalan atau belum kalo belum FIX!!!!. dirasa module nya udah jalan sukses, boleh lanjut kerjain module berikutnya dan begitu seterusnya.**
> DO NOT ATTEMPT TO BUILD ALL MODULES AT ONCE. Build one module, test it, fix it, confirm it works, and only then proceed to the next module.

**Goal:** Implement the 4 missing core features identified from the technical documentation gap analysis into the existing Laravel 9 Monolith. Since the physical hardware (Biometric machines, GPS trackers, EV stations) are still being sourced, the code will be built using Interfaces and Mock Services so the business logic is ready to go.

---

## Module 1: EV Charging (Pengisian Daya Kendaraan Listrik)

**Objective:** Track EV charging stations, sessions, energy consumption, and billing.

### 1. Database & Models
- `EvStation` (name, location, capacity, status)
- `EvChargingSession` (fleet_id, station_id, start_time, end_time, kwh_consumed, total_cost, status)
- **Relationships**: `Fleet` hasMany `EvChargingSession`.

### 2. Controllers & Routes
- `EvStationController` (CRUD stations)
- `EvChargingSessionController` (Log charging sessions, API for IoT integration if needed)
- **Routes**: `Route::resource('ev-stations')`, `Route::resource('ev-sessions')`

### 3. Views
- `ev_stations/index`, `ev_stations/create`
- `ev_sessions/index`, `ev_sessions/create` (Connects to existing `Fleet` dropdown)

---

## Module 2: Biometric Attendance Integration

**Objective:** Sync biometric machine data with the existing HRM Attendance system.

### 1. Database & Models
- `BiometricDevice` (ip_address, port, name, status, last_sync)
- `BiometricLog` (employee_id, device_id, punch_time, punch_state)

### 2. Integration Logic (Services & Mocks)
- **Interface**: Create `App\Contracts\BiometricDeviceInterface` with methods `connect()` and `getAttendance()`.
- **Mock Service**: Create `App\Services\Biometric\MockBiometricService` that implements the interface and returns fake dummy attendance logs for testing purposes.
- **Job/Command**: `php artisan biometric:sync` running on a cron schedule (`app/Console/Kernel.php`) using the Mock service to insert logs into `AttendanceEmployee`.

### 3. Controllers & UI
- `BiometricDeviceController` (Manage connected devices and trigger manual sync).
- **Views**: `biometric_devices/index` (Show device connection status).

---

## Module 3: BRIAPI Integration (Perbankan)

**Objective:** Automate bank statements, transfers, and VA payments using BRIAPI.

### 1. Database & Models
- `BriApiCredential` (client_id, client_secret, token, expiry)
- `BriVirtualAccount` (customer_id, va_number, amount, status)
- `BriTransaction` (Log of incoming/outgoing bank mutations)

### 2. Integration Logic (Services & Mocks)
- **Interface**: Create `App\Contracts\BankApiInterface`.
- **Mock Service**: Create `App\Services\Payment\MockBriApiService` to simulate generating VA and receiving webhook callbacks without hitting real BRI servers.
- **Webhooks**: Create `routes/api.php` endpoints for BRIAPI callbacks to update Invoice statuses automatically.

### 3. Configuration
- Add dummy BRIAPI credentials to `.env`.
- **Views**: Settings tab under Accounting to configure credentials.

---

## Module 4: GPS/Maps Tracking

**Objective:** Live tracking of fleets and trips.

### 1. Database & Models
- `FleetLocation` (fleet_id, trip_id, latitude, longitude, speed, timestamp)

### 2. Integration Logic (API & Mocks)
- **API Endpoint**: `App\Http\Controllers\Api\GpsController` (Endpoint for GPS hardwares to push standard payload: lat, long, speed).
- **Mock Service**: Command `php artisan gps:simulate {trip_id}` to randomly generate and push fake GPS coordinates to the API for UI testing.

### 3. Views & Maps (Frontend)
- `trips/map.blade.php`: Integrasi Leaflet.js (OpenStreetMap).
- Polling via AJAX to render map markers based on `FleetLocation` dummy data.

---

## User Review Required

> [!NOTE]
> The plan is now adapted to use **Mock Services & Interfaces**. We can proceed with writing the code immediately. When the actual devices arrive, the developer only needs to swap the Mock service bindings in the `AppServiceProvider` with the real Hardware Service bindings. No controller or view changes will be required.

---

## Low-RAM Environment Setup (For AI Agent)

> [!TIP]
> **For the AI Agent:** If the host machine has low RAM and cannot run Docker/Sail or heavy MySQL containers, execute the following steps to switch to a lightweight SQLite local environment.

### 1. Database Configuration
Run these commands to create an SQLite database and update the `.env` file:
```bash
touch database/database.sqlite
sed -i '' 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/g' .env
sed -i '' 's/DB_HOST=127.0.0.1/#DB_HOST=127.0.0.1/g' .env
sed -i '' 's/DB_PORT=3306/#DB_PORT=3306/g' .env
sed -i '' 's/DB_DATABASE=gitawaha_erp/#DB_DATABASE=gitawaha_erp/g' .env
sed -i '' 's/DB_USERNAME=gitawaha_erp/#DB_USERNAME=gitawaha_erp/g' .env
sed -i '' 's/DB_PASSWORD=/#DB_PASSWORD=/g' .env
```

### 2. Run Migrations & Server
Execute migrations against the SQLite database and start the native PHP server:
```bash
php artisan migrate:fresh --seed
php artisan serve
```
*The app will now run on `http://127.0.0.1:8000` consuming minimal RAM.*
