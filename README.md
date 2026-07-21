# hospital_appointment_management
# 🏥 MediCare HMS — Hospital Management System

A web-based **Hospital Management System** built with **PHP** and **MySQL** that allows hospital staff to register patients, track admission progress, view records, and manage patient data through a clean and responsive interface.

---

## 📸 Preview

> Register patients, track their admission stage from Admitted → Discharged, and manage all records from one dashboard.

---

## ✨ Features

- ✅ **Patient Registration** — Add patients with name, age, gender, disease, doctor, stage & date
- 📊 **Admission Stage Tracker** — 5-step progress: `Admitted → Diagnosed → Treatment → Recovery → Discharged`
- 📋 **View All Records** — Table view with live search filter
- 📈 **Dashboard Statistics** — Real-time total, male & female patient counts
- 🗂️ **Stage Filter** — Filter progress cards by admission stage
- 🗑️ **Delete with Confirmation** — Modal popup before deleting any record
- 🔔 **Toast Notifications** — Success & error alerts
- 📱 **Responsive Design** — Works on desktop, tablet & mobile

---

## 🛠️ Tech Stack

| Layer      | Technology          |
|------------|---------------------|
| Frontend   | HTML5, CSS3, JavaScript |
| Backend    | PHP 8.0+            |
| Database   | MySQL 8.0           |
| Web Server | Apache (XAMPP/WAMP) |

---

## 📁 Project Structure

```
hospital-management/
├── index.php          # Main SPA shell with sidebar navigation
├── insert.php         # Handle patient registration (POST)
├── view.php           # Fetch & render patient records table
├── progress.php       # Render admission progress cards
├── delete.php         # Delete patient record by ID
└── hospitaldb.sql     # Database schema + sample data
```

---

## ⚙️ Setup & Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/hospital-management.git
```

### 2. Move to Web Server Directory
```bash
# XAMPP
cp -r hospital-management/ C:/xampp/htdocs/

# WAMP
cp -r hospital-management/ C:/wamp64/www/
```

### 3. Import the Database
- Open **phpMyAdmin** → `http://localhost/phpmyadmin`
- Click **Import** → Choose `hospitaldb.sql` → Click **Go**

### 4. Run the Project
- Start **Apache** and **MySQL** in XAMPP/WAMP
- Open browser → `http://localhost/hospital-management/`

---

## 🗄️ Database

**Database:** `hospitaldb`  
**Table:** `patient`

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT (PK) | Auto-incremented patient ID |
| `pname` | VARCHAR(100) | Patient full name |
| `age` | INT | Patient age |
| `gender` | VARCHAR(10) | Male / Female |
| `disease` | VARCHAR(200) | Medical condition |
| `doctor` | VARCHAR(100) | Assigned doctor |
| `stage` | VARCHAR(20) | Admission stage |
| `appointment_date` | DATE | Date of appointment |
| `created_at` | TIMESTAMP | Record creation time |

---

## 📌 Admission Stages

```
🏥 Admitted  →  🔬 Diagnosed  →  💊 Treatment  →  🌿 Recovery  →  ✅ Discharged
```

---

## 🚀 Usage

1. Go to **Register Patient** → Fill in details → Click **Register Patient**
2. Go to **View Records** → Search by any field using the search bar
3. Go to **Admission Progress** → Filter cards by stage
4. Go to **Delete Record** → Enter Patient ID → Confirm deletion

---

## 🙌 Acknowledgements

- [PHP Documentation](https://www.php.net/manual/en/)
- [MySQL Reference](https://dev.mysql.com/doc/)
- [XAMPP](https://www.apachefriends.org/)

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

