# Ticaretify - Full-Stack E-Commerce Platform

Ticaretify is a dynamic, secure, and fully responsive full-stack e-commerce web application developed as a comprehensive graduation project. The platform manages end-to-end e-commerce operations—covering user authentication, dynamic product discovery, session-backed cart architectures, automated relational checkout workflows, and personalized wishlists.

---

## Key Features

*   **Secure Authentication & Session Management:** Built-in registration, login, and secure logout flows utilizing native **PHP Sessions**[cite: 4, 11]. Passwords are secured using **MD5 encryption**, backed by data validation for character limits and password matching.
*   **SQL Injection Protection:** Engineered backend data-fetching architecture using database **Prepared Statements** (`$conn->prepare`) and parameter binding to guarantee protection against common web vulnerabilities.
*   **Dynamic Shopping Cart Engine:** Developed a comprehensive multi-dimensional session cart (`$_SESSION['cart']`) that supports real-time quantity modifications, automated input tracking, validation against duplicate additions, and programmatic total calculations (`calculateTotalCart()`).
*   **Relational Checkout & Order Architecture:** Implements standard database transaction simulation. Captures billing details and accurately processes checkouts by automatically mapping generated master IDs to granular parent-child relational item tables (`orders` and `order_items`).
*   **Personalized Wishlist (Favorites List):** Logged-in users can dynamically curate an interactive wishlist[cite: 8, 21]. Features optimized SQL **JOIN** queries to securely cross-reference user records with product attributes.
*   **Smart Product Discovery:** Includes automated item suggestions on product landing pages, utilizing random query retrieval algorithms (`ORDER BY RAND()`) restricted to matching item categories.
*   **Interactive UI/UX & Responsive Layout:** Crafted a pixel-perfect, completely fluid user experience leveraging **Bootstrap 5**, custom **CSS Grid/Flexbox**, and native **JavaScript DOM manipulation** for client-side interactivity (such as interactive product media galleries).

---

## Tech Stack

*   **Backend:** PHP (Procedural & Prepared Statements Core)
*   **Database:** MySQL (Relational schema structure)
*   **Frontend:** HTML5, CSS3, JavaScript (ES6+), Bootstrap 5 framework
*   **Server Environment:** Apache configuration compatible

---

## Key Database Architecture

The system relies on a relational schema structured within a central database (`php_project`), managing mappings across these primary tables:
*   `users`: Stores credentials, identity records, and profile details.
*   `products`: Holds product details, category definitions, pricing, and distinct image file references.
*   `orders` & `order_items`: Maps user invoice references to detailed breakdown item lists.
*   `favorites`: Intermediary relationship mapping connecting users directly to favorited product IDs.
*   `feedback`: Processes structural site messages and automated user inquiries securely from frontend submission forms.

---

## Installation & Local Setup

To deploy and run this repository locally, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/your-username/ticaretify.git](https://github.com/your-username/ticaretify.git)
Configure Local Environment:Move the project directory to your local server directory (e.g., htdocs for XAMPP or www for WampServer).Database Configuration:Open your local database management tool (e.g., phpMyAdmin).Create a new database named php_project[cite: 22].Import the structured SQL tables (users, products, orders, order_items, favorites, feedback) into the database.  Verify Server Connections:
Ensure your credentials inside server/connection.php accurately reference your local hosting configuration:  PHP$conn = mysqli_connect("localhost", "root", "", "php_project"); // Verify your user details here
Launch:Open your browser and navigate to http://localhost/ticaretify/index.php.
