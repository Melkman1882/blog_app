# Blog Management System

##  About the Project
This is a **Blog Management System** built with Laravel that allows users to create, edit, and delete blog posts. Users can also view all blog posts or filter to see only their own posts.

---

##  Features
- User authentication (register, login, logout)
- Create, edit, and delete blog posts
- View all blogs
- Pagination for better user experience
- Image upload support for blog posts
- Confirmation prompt before deleting a post
- Responsive design with TailwindCSS

---

##  Installation

### **1. Clone the Repository**
```sh
git clone https://github.com/Melkman1882/blog_app.git
cd blog_app
```

### **2. Install Dependencies**
Make sure you have **PHP**, **Composer**, and **Node.js** installed.
```sh
composer install
npm install && npm run build
```

### **3. Configure Environment**
Duplicate the `.env.example` file and rename it to `.env`:
```sh
cp .env.example .env
```
Generate the application key:
```sh
php artisan key:generate
```

### **4. Set Up the Database**
Ensure you have **MySQL** or another database configured. Update the `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
Then run migrations and seed the database:
```sh
php artisan migrate --seed
```

### **5. Start the Development Server**
```sh
php artisan serve
```
Visit `http://127.0.0.1:8000` in your browser.

---


##  Usage
- **Creating a Post:** Click on `+ Create New Post`, fill in the details, and submit.
- **Editing a Post:** Click `Edit` on your post and modify the content.
- **Deleting a Post:** Click `Delete`, and a confirmation prompt will appear.
- **Switching Between Tabs:** Use `All Blogs` to view all posts and `My Blogs` to filter your own.

---

##  Contribution
Want to contribute? Feel free to submit a **Pull Request** or open an **Issue** with suggestions!

---

##  License
This project is open-source and available under the **MIT License**.

---

##  Contact
For any questions or issues, contact me at:
- GitHub: [Melkman1882](https://github.com/Melkman1882)
- Email: ruanmalanwow@gmail.com

