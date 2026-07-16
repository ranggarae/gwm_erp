# Fleet Management System - Design Specification
**Date:** 2026-07-16
**Status:** Approved for Implementation Planning

## 1. Overview
The Fleet Management System is an extension to the existing ERP monolith (Laravel 9). It provides capabilities to track vehicles, manage independent drivers (third-party/outsourced), record trips, and handle fleet-related expenses (fuel, maintenance, etc.) with a rigid Maker-Checker-Approver workflow before posting to the financial ledger.

## 2. Architecture & Approach
We are adopting **Approach 2 (Post-to-Finance Workflow)**:
- The Fleet module is highly independent for daily operations.
- Fleet expenses (fuel, maintenance) are recorded in the Fleet module and undergo an operational approval process.
- Approved expenses can be explicitly pushed ("Posted") to the main Accounting module (`Expense`), converting operational data into financial ledger entries without dirtying the finance books with draft or unverified field entries.

## 3. Database Schema / Entities

### `fleets` (Vehicles)
- `id` (PK)
- `name` / `brand` (string)
- `license_plate` (string, unique)
- `year` (integer)
- `engine_capacity` (string)
- `photo` (string, nullable)
- `stnk_expiry_date` (date)
- `kir_expiry_date` (date, nullable)
- `insurance_expiry_date` (date, nullable)
- `status` (enum: Available, In Use, Maintenance)
- timestamps

### `drivers`
- `id` (PK)
- `name` (string)
- `license_number` (string)
- `license_type` (string - e.g., SIM A, SIM B1)
- `license_expiry_date` (date)
- `phone` (string)
- `status` (enum: Available, On Trip, Leave)
- timestamps

### `trips`
- `id` (PK)
- `fleet_id` (FK to fleets)
- `driver_id` (FK to drivers)
- `route_destination` (text)
- `purpose` (text)
- `start_date` (datetime)
- `end_date` (datetime, nullable)
- `start_odometer` (integer)
- `end_odometer` (integer, nullable)
- `status` (enum: Scheduled, Ongoing, Completed, Cancelled)
- timestamps

### `fleet_expenses`
- `id` (PK)
- `fleet_id` (FK to fleets)
- `trip_id` (FK to trips, nullable)
- `expense_type` (enum: Fuel, Maintenance, Toll, Parking, Others)
- `amount` (decimal)
- `description` (text)
- `attachment` (string, receipt photo)
- `status` (enum: Pending, Approved, Rejected, Posted)
- `expense_id` (FK to existing `expenses` table - to track if it's been pushed to Finance)
- `approved_by` (FK to users, nullable)
- timestamps

## 4. UI/UX Components
- **Dashboard Widgets:** Alerts for expiring documents (STNK < 30 days, KIR, SIM), Active Trips, Pending Approvals.
- **Fleet Master Data Menu:** CRUD for Vehicles and Drivers.
- **Trip Log Menu:** Assign drivers to cars, record odometer.
- **Expenses Menu:** Input forms for operational costs, approval buttons for managers, and a strict "Post to Finance" button for approved entries.

## 5. Integration Points
- **Accounting Module:** When a `fleet_expense` is marked as Approved, authorized personnel can click "Post to Finance". This will create a record in the core `expenses` table mapping to a specific Chart of Account (e.g., "Biaya Kendaraan / Transportasi"), and update the `fleet_expenses.expense_id` to establish the link.

## 6. Constraints & Rules
- Deletion of `fleet_expenses` is prohibited once the status is `Posted`.
- A `driver` cannot be assigned to a new `trip` if their status is `On Trip`.
- A `fleet` cannot be assigned if its status is `In Use` or `Maintenance`.
