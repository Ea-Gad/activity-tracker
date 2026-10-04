# Activity Tracker

A Laravel-based system for tracking daily activities of an applications support team,
with handover views, reporting, and full audit trail.

## Features

- User authentication (Laravel Breeze)
- Activity CRUD (admin only)
- Append-only activity updates with status (done/pending) + remarks
- Performer bio snapshot + timestamp on every update (audit trail)
- Daily handover view (all activities, latest update, full trail)
- Reports with custom date ranges, filters, and CSV export
- Role-based authorization (admin / support)
- Modern responsive UI with dark mode

## Tech Stack

- PHP 8.3
- Laravel 11
- MySQL / SQLite / PostgreSQL
- Blade + Tailwind CSS
- Vite

## Setup

```bash
git clone <repo-url>
cd activity-tracker
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite    # since i am using SQLite
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

Visit http://127.0.0.1:8000

## Demo Credentials

| Role    | Email               | Password |
|---------|---------------------|----------|
| Admin   | admin@example.com   | password |
| Support | sam@example.com     | password |

## Key Design Decisions

- **Append-only updates** — every status change is a new record, so the full
  audit trail is preserved and the handover view can show exactly who did what
  and when.
- **Bio snapshot on updates** — `performed_by_name` and `performed_by_role`
  are copied into the update row at write time, so historical records stay
  accurate even if the user's name or title changes later.
- **Business date vs. timestamp** — `activity_date` captures the business
  day an update is *for*, while `performed_at` captures when it was
  *recorded*. This supports back-dated updates without losing audit fidelity.
- **Indexed queries** — composite indexes on
  `(activity_id, activity_date)`, `(user_id, performed_at)`, and `status`
  keep the dashboard and reports fast as data grows.

## Project Structure

```
app/
├── Http/Controllers/    DashboardController, ActivityController,
│                        ActivityUpdateController, HandoverController,
│                        ReportController
├── Http/Requests/       StoreActivityRequest, StoreActivityUpdateRequest
├── Models/              User, Activity, ActivityUpdate
├── Policies/            ActivityPolicy
└── Services/            ActivityService (core business logic)

database/migrations/     users (+role), activities, activity_updates
database/seeders/        demo users + activities + updates

resources/views/         Blade templates (dashboard, handover, reports, CRUD)
routes/web.php           App routes
```

## Testing

```bash
php artisan test
```

## Author

Gad Amakye Eluakeh