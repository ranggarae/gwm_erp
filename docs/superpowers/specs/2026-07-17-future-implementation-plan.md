# Future Implementation Plan: 4 Missing Core Modules

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Implement the 4 missing core features identified from the technical documentation gap analysis into the existing Laravel 9 Monolith.

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

**Objective:** Sync biometric machine data (e.g., ZKTeco, Hikvision) with the existing HRM Attendance system.

### 1. Database & Models
- `BiometricDevice` (ip_address, port, name, status, last_sync)
- `BiometricLog` (employee_id, device_id, punch_time, punch_state)

### 2. Integration Logic (Services)
- `App\Services\Biometric\ZKTecoService` (Uses a PHP library like `raihanafroz/zkteco` to pull data from devices via TCP/UDP).
- **Job/Command**: `php artisan biometric:sync` running on a cron schedule (`app/Console/Kernel.php`) to fetch logs and insert them into the existing `AttendanceEmployee` model.

### 3. Controllers & UI
- `BiometricDeviceController` (Manage connected devices and trigger manual sync).
- **Views**: `biometric_devices/index` (Show device connection status).

---

## Module 3: BRIAPI Integration (Perbankan)

**Objective:** Automate bank statements, transfers, and VA (Virtual Account) payments using BRIAPI.

### 1. Database & Models
- `BriApiCredential` (client_id, client_secret, token, expiry)
- `BriVirtualAccount` (customer_id, va_number, amount, status)
- `BriTransaction` (Log of incoming/outgoing bank mutations)

### 2. Integration Logic (Services)
- `App\Services\Payment\BriApiService` (Handles authentication / token generation, signature creation (HMAC-SHA256), and API requests).
- **Webhooks**: Create `routes/api.php` endpoints for BRIAPI callbacks (e.g., payment success notifications) to update Invoice statuses automatically.

### 3. Configuration
- Add BRIAPI credentials to `.env`.
- **Views**: Settings tab under Accounting to configure BRIAPI credentials.

---

## Module 4: GPS/Maps Tracking

**Objective:** Live tracking of fleets and trips using GPS telemetry data (e.g., Traccar, Google Maps API, or direct IoT).

### 1. Database & Models
- `FleetLocation` (fleet_id, trip_id, latitude, longitude, speed, timestamp)

### 2. Integration Logic (API & Services)
- `App\Http\Controllers\Api\GpsController` (Endpoint for GPS hardwares to push standard payload: lat, long, speed).
- Alternatif: Webhook integration if using 3rd party like Traccar/Wialon.

### 3. Views & Maps (Frontend)
- `trips/map.blade.php`: Integrasi Leaflet.js (OpenStreetMap) atau Google Maps API.
- Polling via AJAX / Livewire untuk me-render pergerakan kendaraan (*live tracking*) berdasarkan data `FleetLocation` terbaru.

---

## User Review Required

> [!IMPORTANT]
> The next developer should verify the hardware specifications (Biometric brand, GPS protocol) and obtain BRIAPI Sandbox credentials before starting the integration steps.

## Verification Plan
1. **EV Charging**: Manual input forms + validation.
2. **Biometric**: Mock API or local test device for sync validation.
3. **BRIAPI**: Use BRIAPI Sandbox environment for Unit Testing signatures.
4. **GPS**: Postman script to push fake GPS coordinates and check if the map marker moves.
