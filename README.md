# 🛡️ Safe Reach - GBV Management System

A comprehensive Gender-Based Violence (GBV) case management system built with Laravel, designed to facilitate reporting, tracking, and management of GBV cases across multiple stakeholders.

## 🌟 Features

### Multi-Role System
- **👤 Victims** - Report cases (anonymous or identified), track case progress, access support resources
- **👮 Law Enforcement** - Receive and manage reported cases, assign to medical/counseling, track investigations
- **🏥 Medical Staff** - Review medical cases, document findings, provide medical reports
- **💙 Counselors** - Conduct counseling sessions, document progress, track recovery
- **⚙️ Super Admin** - Manage all users, oversee all cases, generate system-wide reports

### Core Functionality
✅ **Anonymous Reporting** - Victims can report cases anonymously with identity protection  
✅ **Case Workflow Management** - Multi-stage case progression (Law Enforcement → Medical → Counseling → Closed)  
✅ **Role-Based Access Control** - Secure access based on user roles  
✅ **Case History Tracking** - Complete audit trail of all case actions  
✅ **Real-Time Statistics** - Dynamic dashboards with case metrics  
✅ **Comprehensive Reporting** - Generate reports by type, status, and stage  
✅ **User Management** - Create, update, and manage system users  

## 🚀 Tech Stack

- **Framework:** Laravel 10.x
- **PHP:** 8.1+
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Blade Templates
- **Icons:** Tabler Icons
- **Charts:** ApexCharts

## 📋 Prerequisites

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM (for assets)

## 🔧 Installation

1. **Clone the repository**
```bash
git clone https://github.com/TapiwanasheE/safereach-gbv-system.git
cd safereach-gbv-system
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=safereach_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations and seeders**
```bash
php artisan migrate:fresh --seed
```

6. **Start the development server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 👥 Default Login Credentials

After running the seeders, you can login with:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@safereach.com | password |
| Law Enforcement | lawenforcement@safereach.com | password |
| Medical Staff | medical@safereach.com | password |
| Counselor | counselor@safereach.com | password |
| Victim | victim@safereach.com | password |

**⚠️ Change these passwords in production!**

## 📊 Database Schema

### Main Tables
- `users` - System users with role assignments
- `roles` - User roles (Victim, Law Enforcement, Medical, Counselor, Super Admin)
- `gbv_cases` - Case records with details, status, stage, and assignments
- `case_histories` - Complete audit trail of case actions and stage transitions

### Key Relationships
- Users have one Role
- Cases belong to a User (victim)
- Cases can be assigned to Staff (assignedStaff)
- Cases have many Case Histories

## 🔄 Case Workflow

```
Victim Reports Case
        ↓
  Law Enforcement
     ↙    ↓    ↘
Medical  Direct  Counseling
   ↓     Close      ↓
Counseling    ←     Medical
   ↓                   ↓
 Close              Close
```

## 🎯 Key Features by Role

### Victim Dashboard
- Report new cases (anonymous option)
- View my cases
- Track case status and stage
- View medical/counseling updates
- Access support resources
- Emergency contacts

### Law Enforcement Dashboard
- View all reported cases
- Assign cases to medical/counseling
- Update case status
- Track investigations
- Generate reports
- Manage profile

### Medical Dashboard
- View assigned medical cases
- Submit medical reviews and findings
- Track pending/completed reviews
- Push cases to counseling or close
- Generate medical reports

### Counselor Dashboard
- View assigned counseling cases
- Document counseling sessions
- Track session counts
- Close cases after counseling
- Generate counseling reports

### Super Admin Dashboard
- Manage all system users (CRUD)
- View all cases across the system
- Assign/reassign cases
- Generate system-wide reports
- View audit logs
- Manage roles and permissions

## 📁 Project Structure

```
safereach-gbv-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── CaseController.php
│   │   ├── VictimController.php
│   │   ├── LawController.php
│   │   ├── MedicalController.php
│   │   ├── CounselorController.php
│   │   └── SuperUserController.php
│   └── Models/
│       ├── User.php
│       ├── role.php
│       ├── gbv_case.php
│       └── CaseHistory.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── victim/
│       ├── law/
│       ├── medical/
│       ├── counsellor/
│       ├── superadmin/
│       └── layouts/
├── routes/
│   └── web.php
└── public/
    └── assets/
```

## 🔐 Security Features

- ✅ Password hashing with bcrypt
- ✅ CSRF protection on all forms
- ✅ Role-based middleware
- ✅ Anonymous reporting with identity protection
- ✅ Secure case assignment validation
- ✅ Authorization checks for data access

## 🎨 UI/UX Highlights

- Modern, responsive Bootstrap 5 design
- Color-coded status badges
- Real-time statistics cards
- Interactive case timelines
- Mobile-friendly interface
- Accessible forms and navigation

## 📈 Future Enhancements

- [ ] SMS/Email notifications
- [ ] File upload for case evidence
- [ ] Advanced search and filtering
- [ ] Export reports to PDF/Excel
- [ ] Multi-language support
- [ ] Two-factor authentication
- [ ] Mobile app integration
- [ ] Real-time chat support

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Tapiwanashe E**
- GitHub: [@TapiwanasheE](https://github.com/TapiwanasheE)

## 🆘 Support

For support, please open an issue in the GitHub repository or contact the project maintainer.

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap Team
- Tabler Icons
- ApexCharts
- All contributors and testers

---

**⚠️ Important Notice:** This system handles sensitive information. Ensure proper security measures are in place before deploying to production.

**🌍 Making a Difference:** Built to support GBV survivors and facilitate better coordination among support services.
