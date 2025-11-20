# Zengfy Database Design

This document defines the core relational models that power Zengfy’s hybrid SaaS platform. Each table resides in a single multi-tenant schema keyed by `account_id`.

## Shared Entities

### `accounts`
- `id` UUID primary key
- `name`, `organization`
- `email`, `phone`
- `status` (free/pending/active/suspended)
- `billing_plan_id`
- `created_at`, `updated_at`

### `billing_plans`
- `id`
- `slug` (`free`, `creator`, `premium`)
- `name`, `description`
- `price_bdt`
- `entitlements` JSON (e.g., `["ecommerce","school","habit"]`)

### `users`
- `id`, `account_id` FK `accounts`
- `name`, `email`, `phone`
- `password` (bcrypt)
- `role` enum (`owner`, `admin`, `ops`, `teacher`, `seller`, `habit_user`)
- `active`, `last_login_at`
- `password_reset_token`, `two_factor_secret`

### `services`
- `id`, `slug` (`ecommerce`, `school`, etc.)
- `name`, `description`
- `category` (`commerce`, `education`, `habit`, `ai`)
- `icon`, `feature_flags` JSON
- `default_subdomain` (e.g., `ecommerce.zengfy`)

## Module Tables

### Ecommerce
- `products` (`account_id`, `title`, `price_bdt`, `stock`, `category_id`, `image`)
- `orders` (`account_id`, `user_id`, `status`, `total_amount`, `payment_provider`, `payment_status`)
- `order_items` (`order_id`, `product_id`, `quantity`, `unit_price`, `ai_suggestion` JSON)
- `messages` (seller-buyer chat)

### School ERP
- `students` (`account_id`, `admission_no`, `name`, `grade`, `guardian_contact`)
- `teachers` (`account_id`, `name`, `subject`, `salary`)
- `classes`, `routines`, `exams`
- `attendances` (`student_id`, `date`, `status`, `remarks`)
- `fees` (`student_id`, `term`, `amount`, `status`)
- `parents` + `guardian` join table

### POS
- `registers` (cash drawer metadata)
- `transactions` (`account_id`, `terminal_id`, `staff_user_id`, `total`)
- `inventory_logs`

### Hotel
- `properties`, `rooms`, `bookings`, `staff`, `expenses`

### Habit Tracking
- `habit_templates`, `habit_sessions`, `insights`
- `habit_sessions` stores AI sentiment/predictive outcomes

### AI Calendar
- `ai_events`, `reminders`, `sent_notifications`
- `ai_events` tie back to `users` and `external_email`

## Support Tables

- `subscriptions` tracks active entitlements per `account_id`
- `payments` for invoices, stores gateway response JSON
- `notifications` (email/SMS) with `status`
- `logs` (json metadata) for auditing and AI triggers

## Data Strategy

- Partition by `account_id` where possible (`WHERE account_id = ?`) for isolation.
- Use `JSON` columns for flexible AI prompts/configurations (e.g., `ai_preferences`).
- Archive older school data (attendance, exams) into `history` tables w/ retention policy.

## Indexing & Security

- Compound indexes on `(account_id, user_id)` for lookups.
- Rows include `created_by`, `updated_by` for traceability.
- All PII encrypted at rest; guard user emails and phone numbers with application-level masking when exported.
