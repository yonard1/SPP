# 🖥️ School Payment Management System (Aplikasi SPP)

The School Payment Management System is a web application built with Laravel, designed to help schools efficiently manage students' tuition fees (SPP), transactions, and financial reports. It provides a user-friendly interface with role-based access for administrators, staff, and students.

---

## Key Features

### User Authentication & Authorization
*   **Multi-Auth System:** Secure login access for 3 different roles: Admin, Staff, and Student.
*   **Role-Based Access Control:** Restricts access to specific features based on the logged-in user's role.

### Master Data Management (Admin Only)
*   **Student Management:** Add, edit, and delete student records including NISN, name, and class.
*   **Class & Major Management:** Organize students into respective classes and majors.
*   **Tuition Fee (SPP) Settings:** Define and manage monthly SPP payment values.

### Transaction & Payment Management
*   **Payment Entry:** Admin and Staff can record and validate monthly SPP payments from students.
*   **Transaction History:** View detailed real-time logs of all payment history.
*   **Student Self-Check:** Students can log in using their NISN to check their payment status (Paid / Unpaid) and personal history without visiting the financial office.

### Reporting & Analytics
*   **Interactive Dashboard:** Visualizes collection data and statistics using charts.
*   **Report Generation:** Export comprehensive payment reports to PDF or Excel formats based on date range, class, or individual student.

---

## Technologies Used

*   **Laravel Framework:** Robust PHP framework for building the backend logic.
*   **Vite:** Modern frontend asset bundler for fast development.
*   **Bootstrap / Tailwind CSS:** Frontend UI frameworks for responsive and clean layout design.
*   **MySQL Database:** Stores application data including students, users, and payment transactions.

---

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository**
```bash
   git clone [https://github.com/yonard1/SPP.git](https://github.com/yonard1/SPP.git)
   cd SPP
