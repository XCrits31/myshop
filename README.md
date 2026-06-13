# Full-Stack E-Shop

A modular e-commerce web application built to practice modern full-stack development with Laravel, Vue.js, and relational database design. 

The goal of this project was to implement core e-commerce mechanics from scratch, focusing on cart state management and a flexible database schema for promotional discounts.

## Core Features

* **Authentication & Profiles:** Secure user onboarding and session management powered by Laravel Breeze.
* **Global Shopping Cart:** Integrated `gloudemans/shoppingcart` package. The cart state is available across all pages, rendering detailed product metrics, quantities, and price updates in real time.
* **Dynamic Discount Engine:** A database-driven promotion system that allows applying three types of discounts:
  * Product-specific (flat or percentage off on a single item).
  * Category-based (discounts applied automatically to all items in a specific category).
  * Order-total (cart-wide deductions or promo codes).
* **Payment History & Analytics:** A dedicated user/admin dashboard section to track completed transactions, with server-side filtering by custom date ranges.

## Tech Stack & Architecture

* **Backend:** PHP 8.2+, Laravel 11, Eloquent ORM
* **Frontend:** Vue.js, TailwindCSS / Bootstrap, Node.js (Vite)
* **Database:** MySQL
* **Dependency Management:** Composer, NPM

## Database & Logic

* **Cart Persistence:** The cart automatically syncs across sessions, ensuring users don't lose their picked items on refresh or re-login.
* **Discount Cascading:** The discount logic checks for overlapping rules and applies the priority rule to avoid unintended double-deductions.
* **Date Filtering:** Payment history queries use Eloquent's `whereBetween` constraints with optimized timestamp indexing to ensure quick database responses even with large mock datasets.
