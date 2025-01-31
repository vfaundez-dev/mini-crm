# - VFH Mini CRM -

For Spanish version, see [README.md](README.md)

## Description

**VFH Mini CRM** is a simple system that implements the basic functionalities of a CRM. 
This system follows the **repository pattern**, allowing for an organized and efficient data flow.

### Main Features:
- Implementation of the repository pattern.
- Complete CRUD for all modules.
- Validations and specific methods in each module.
- Authentication with **Laravel UI** (Login and Registration).
- Design based on **AdminLTE** template.
- Main modules:
  - **Clients**
  - **Contacts**
  - **Activities**
  - **Opportunities**
  - **Users**
- Does not include a role system at the moment.

## System Requirements

To run **VFH Mini CRM**, ensure that you meet the following requirements:

- **Web Server**: Apache/Nginx
- **PHP**: Version 8.2 or higher
- **Composer**: Latest version
- **NodeJS**: Version 18 or higher
- **MySQL**: Version 5.8 or higher

## Installation

### 1. Clone the repository
```bash
  git clone https://github.com/vfaundez-dev/mini-crm.git
  cd vfh-mini-crm
```

### 2. Configure the environment
Copy the environment file and set the necessary parameters:
```bash
cp .env.example .env
```

Modify the database credentials in the `.env` file:
```env
DB_HOST=your_host
DB_DATABASE=vfh_mini_crm
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### 3. Install dependencies
```bash
composer install
npm install
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Create the database
Ensure that the **vfh_mini_crm** database is created in MySQL.

### 6. Run migrations and seeders
```bash
php artisan migrate --seed
```

### 7. Install AdminLTE and associated plugins
```bash
npm run build
```

### 8. Start servers
Start the development server for AdminLTE:
```bash
npm run dev
```

Start the Laravel server:
```bash
php artisan serve
```

## Usage
Access the system via: [http://localhost:8000](http://localhost:8000) or your configured host.

## License

![Creative Commons License](https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png)  
This project is licensed under the [Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License](https://creativecommons.org/licenses/by-nc-nd/4.0/).

### Summary
- **Attribution**: You must give appropriate credit to the original author.
- **Non-Commercial**: You may not use the material for commercial purposes.
- **No Derivatives**: If you remix, transform, or build upon the material, you may not distribute the modified material.

For more details, see the `LICENSE` file included in this repository.

---
Developed and maintained by **© 2025 Vladimir Faundez Hernández. All rights reserved.**
