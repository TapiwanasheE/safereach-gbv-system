# Victim Side - Complete Features Documentation

## 🎯 Overview
The victim side of SafeReach GBV platform provides a secure, confidential environment for victims to report cases, track progress, and access support services.

---

## ✨ Features Implemented

### 1. **Dashboard** (`/victim/dashboard`)
- **Dynamic Statistics Cards:**
  - Total Cases Reported
  - Pending Cases
  - Resolved Cases
  
- **Quick Action Buttons:**
  - Report New Case
  - View My Cases
  - Get Help & Support
  
- **Emergency Contacts Section:**
  - Police Emergency: 999
  - Medical Emergency: 112
  - GBV Helpline: 0800-123-456
  
- **Important Information Panel:**
  - Confidentiality notice
  - Available support services
  - 24/7 access information

### 2. **Report Case** (`/report-case`)
- **Case Reporting Form:**
  - Case Type Selection (6 violence types)
    - Physical Violence
    - Sexual Violence
    - Emotional or Psychological Violence
    - Economic or Financial Violence
    - Cultural or Social Violence
    - Digital or Online Violence
  - Date of Incident
  - Location (Optional)
  - Detailed Description
  - Anonymous Reporting Option
  
- **Features:**
  - Automatic case number generation (CASE-YYYYMMDD-XXXXXX)
  - Initial stage set to "Law Enforcement"
  - Status set to "Reported"
  - Success/Error notifications

### 3. **My Cases** (`/victim/my-cases`)
- **Case List View:**
  - Case Number
  - Case Type
  - Date Reported
  - Current Status (color-coded badges)
  - Current Stage
  - Assigned Staff Member (with role)
  - View Details Action Button
  
- **Features:**
  - View all reported cases
  - Filter by status
  - Click-through to case details
  - Empty state with "Report First Case" CTA

### 4. **Case Detail View** (`/victim/cases/{id}`)
- **Case Information Section:**
  - Case Number
  - Case Type
  - Date Reported
  - Location
  - Full Description
  
- **Current Status Panel:**
  - Status Badge (color-coded)
  - Current Stage Badge
  - Assigned Staff Information (if assigned)
    - Staff Name
    - Staff Role
    - Staff Icon
  
- **Case Updates & History:**
  - Timeline of all case activities
  - Action descriptions
  - Timestamps
  - Staff who performed actions
  
- **Quick Actions:**
  - Back to My Cases
  - Report Another Case

### 5. **Sidebar Navigation**
- **Home Section:**
  - Dashboard
  - Report Case
  
- **Case Management:**
  - My Cases
  
- **Resources:**
  - GBV Support Materials
  - Help & Support
  
- **Configurations:**
  - My Profile

---

## 🔒 Security Features

1. **Authentication Required:** All victim routes require login
2. **Role-Based Access:** Only users with "Victim" role can access
3. **Data Privacy:** Victims can only see their own cases
4. **Confidentiality:** All data handled securely
5. **Anonymous Reporting:** Option to report cases anonymously

---

## 🎨 UI/UX Features

1. **Responsive Design:** Works on all devices
2. **Color-Coded Status:**
   - Blue (Info): Reported
   - Yellow (Warning): In Progress
   - Green (Success): Resolved
   - Gray (Secondary): Other statuses

3. **Interactive Cards:** Hover effects and clear CTAs
4. **Progress Indicators:** Visual progress bars
5. **Icons:** Intuitive Tabler icons throughout
6. **Breadcrumbs:** Easy navigation tracking

---

## 🔄 Case Workflow

1. **Victim Reports Case** → Status: "Reported", Stage: "Law Enforcement"
2. **Law Enforcement Reviews** → Assigns to Medical/Counselor
3. **Medical Review** → Medical staff performs review
4. **Counseling** → Counselor provides support
5. **Case Resolution** → Status: "Resolved"

---

## 📱 Test Account

**Email:** `victim@safereach.com`  
**Password:** `Victim@123`

---

## 🚀 Routes Summary

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/victim/dashboard` | `vic-dashboard` | Victim dashboard |
| GET | `/report-case` | `vic-create-case` | Report case form |
| POST | `/report-case` | `vic-case-store` | Submit case |
| GET | `/victim/my-cases` | `vic-my-cases` | View all cases |
| GET | `/victim/cases/{id}` | `vic-case-detail` | View case details |

---

## 📝 Files Added/Modified

### Controllers
- `app/Http/Controllers/VictimController.php` - Enhanced with all methods

### Views
- `resources/views/victim/dashboard.blade.php` - Enhanced with dynamic data & quick actions
- `resources/views/victim/create-case.blade.php` - Existing form
- `resources/views/victim/my-cases.blade.php` - **NEW** - Case list view
- `resources/views/victim/case-detail.blade.php` - **NEW** - Case detail view

### Layouts
- `resources/views/layouts/victimmaster.blade.php` - Updated navigation

### Routes
- `routes/web.php` - Added victim case viewing routes

### Database
- `app/Models/gbv_case.php` - Added fillable fields and relationships
- `database/seeders/VictimUserSeeder.php` - **NEW** - Test victim user

---

## 🎯 Future Enhancements (Optional)

1. **Real-time Notifications:** Case status change alerts
2. **Document Upload:** Allow victims to upload evidence/documents
3. **Chat Feature:** Direct messaging with assigned staff
4. **Appointment Scheduling:** Book counseling sessions
5. **Resource Library:** Access to GBV support materials
6. **Multi-language Support:** Translate interface
7. **Export Case Reports:** Download case history as PDF
8. **Safety Planning Tools:** Personal safety plan builder

---

## ✅ Checklist

- [x] Dynamic dashboard with real statistics
- [x] Case reporting functionality
- [x] View all cases
- [x] View individual case details
- [x] Track case status and progress
- [x] See assigned staff
- [x] Emergency contacts display
- [x] Quick action buttons
- [x] Sidebar navigation
- [x] Security & role-based access
- [x] Test victim user seeded
- [x] Responsive design
- [x] Success/error messages

---

## 📞 Support

For any issues or questions, contact the system administrator or refer to the main documentation.

---

**Last Updated:** October 1, 2025  
**Version:** 1.0.0

