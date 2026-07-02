Markdown# Ticaretify - Full-Stack E-Commerce Platform

Ticaretify is a dynamic, secure, and fully responsive full-stack e-commerce web application developed as a comprehensive graduation project[cite: 2]. The platform manages end-to-end e-commerce operations—covering user authentication, dynamic product discovery, session-backed cart architectures, automated relational checkout workflows, and personalized wishlists[cite: 3, 4, 5, 8, 18].

---

## Key Features

*   **Secure Authentication & Session Management:** Built-in registration, login, and secure logout flows utilizing native **PHP Sessions**[cite: 4, 11]. Passwords are secured using **MD5 encryption**, backed by data validation for character limits and password matching[cite: 4].
*   **SQL Injection Protection:** Engineered backend data-fetching architecture using database **Prepared Statements** (`$conn->prepare`) and parameter binding to guarantee protection against common web vulnerabilities[cite: 3, 4].
*   **Dynamic Shopping Cart Engine:** Developed a comprehensive multi-dimensional session cart (`$_SESSION['cart']`) that supports real-time quantity modifications, automated input tracking, validation against duplicate additions, and programmatic total calculations (`calculateTotalCart()`)[cite: 5].
*   **Relational Checkout & Order Architecture:** Implements standard database transaction simulation. Captures billing details and accurately processes checkouts by automatically mapping generated master IDs to granular parent-child relational item tables (`orders` and `order_items`)[cite: 18].
*   **Personalized Wishlist (Favorites List):** Logged-in users can dynamically curate an interactive wishlist[cite: 8, 21]. Features optimized SQL **JOIN** queries to securely cross-reference user records with product attributes[cite: 8].
*   **Smart Product Discovery:** Includes automated item suggestions on product landing pages, utilizing random query retrieval algorithms (`ORDER BY RAND()`) restricted to matching item categories[cite: 3].
*   **Interactive UI/UX & Responsive Layout:** Crafted a pixel-perfect, completely fluid user experience leveraging **Bootstrap 5**, custom **CSS Grid/Flexbox**, and native **JavaScript DOM manipulation** for client-side interactivity (such as interactive product media galleries)[cite: 3, 13].

---

## Tech Stack

*   **Backend:** PHP (Procedural & Prepared Statements Core)[cite: 3, 4]
*   **Database:** MySQL (Relational schema structure)
*   **Frontend:** HTML5, CSS3, JavaScript (ES6+), Bootstrap 5 framework[cite: 3, 13]
*   **Server Environment:** Apache configuration compatible[cite: 2]

---

## Key Database Architecture

The system relies on a relational schema structured within a central database (`php_project`), managing mappings across these primary tables[cite: 22]:
*   `users`: Stores credentials, identity records, and profile details[cite: 4, 11].
*   `products`: Holds product details, category definitions, pricing, and distinct image file references[cite: 3].
*   `orders` & `order_items`: Maps user invoice references to detailed breakdown item lists[cite: 18].
*   `favorites`: Intermediary relationship mapping connecting users directly to favorited product IDs[cite: 8, 21].
*   `feedback`: Processes structural site messages and automated user inquiries securely from frontend submission forms[cite: 19].

---

## Installation & Local Setup

To deploy and run this repository locally, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/your-username/ticaretify.git](https://github.com/your-username/ticaretify.git)
Configure Local Environment:Move the project directory to your local server directory (e.g., htdocs for XAMPP or www for WampServer).Database Configuration:Open your local database management tool (e.g., phpMyAdmin).Create a new database named php_project[cite: 22].Import the structured SQL tables (users, products, orders, order_items, favorites, feedback) into the database.  Verify Server Connections:
Ensure your credentials inside server/connection.php accurately reference your local hosting configuration:  PHP$conn = mysqli_connect("localhost", "root", "", "php_project"); // Verify your user details here[cite: 22]
Launch:Open your browser and navigate to http://localhost/ticaretify/index.php.
