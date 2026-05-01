# Scandiweb E-Commerce Project

## Overview

This project is a full-stack e-commerce application built as part of the Scandiweb assessment. It consists of a React frontend, a PHP backend exposing a GraphQL API, and a MySQL database, all containerized using Docker and hosted via Cloudflare service, but can also be tested locally via Docker.

The application supports product browsing, attribute-based selection, cart management, and order placement with persistent storage.

---

## Tech Stack

- **Frontend:** React.js
- **Backend:** PHP (GraphQL API)
- **Database:** MySQL (MariaDB-compatible)
- **Containerization:** Docker

---

## Project Structure

```
/client -> React client application (With dockerfile)
/server -> PHP GraphQL API (With dockerfile)
docker-compose.yml -> Docker configuration file
scandiweb_test.sql -> SQL dump (schema + product seed data)
```

## 🌐 Access Points (Deployed)

- **Frontend (Store):**
  https://sopo.abracadabratp.xyz/all

- **GraphQL API:**
  https://api.abracadabratp.xyz/graphql (It's normal to see an error message there if opening through browser)

---

## 🚀 Running the Project locally with Docker

Build and start all services:

```bash
docker-compose up -d --build
```

To stop the project:

```bash
docker-compose down
```

This will start:

- Frontend service
- Backend service
- MySQL database

---

## 🌐 Access Points (Docker)

Once the project is running:

- **Frontend (Store):**
  http://localhost:8080/category/all

- **GraphQL API:**
  http://localhost:8000/graphql

---

## 🗄️ Database Setup (Required)

The database is **not automatically seeded**.
You must import the provided SQL dump manually.

### Step 1: Ensure containers are running

```bash
docker-compose up -d
```

---

### Step 2: Import the database

Run the following command from the project root:

```bash
docker exec -i db mysql -u root -proot scandiweb < scandiweb_test.sql
```

---

### Notes

- `db` is the MySQL container name defined in `docker-compose.yml`
- The database `scandiweb` is created automatically by the container
- The SQL file includes:
  - full schema
  - product data
  - categories and attributes

- **Orders are not pre-seeded** and will be created during testing

---

## 🧪 Evaluation Guide

This section describes how to verify that the system works correctly.

---

### 1. Product Browsing

- Navigate between categories (All, Clothes, Tech)
- Confirm products load correctly per category

---

### 2. Product Details

- Open a product page
- Select attributes (e.g. size, color)
- Ensure selections update the product state

---

### 3. Cart Functionality

- Add products to cart
- Increase/decrease quantities
- Remove items from cart

---

### 4. Order Placement

- Add items to cart
- Place an order

---

### 5. Verify Order Persistence

After placing an order, confirm it is stored in the database.

#### Connect to MySQL container:

```bash
docker exec -it my_site-db-1 mysql -u root -proot scandiweb
```

#### Check orders:

```sql
SELECT * FROM orders;
```

You should see newly created records.

#### (Optional) Check order items:

```sql
SELECT * FROM order_items;
```

---

## GraphQL API (Examples)

### Get categories

```graphql
query {
  categories {
    id
    name
  }
}
```

---

### Get products by category

```graphql
query GetProductsByCategory($category: String!) {
  products(category: $category) {
    id
    product_uid
    name
    in_stock
    product_gallery
    product_prices {
      amount
      currency_symbol
    }
    product_attributes {
      attribute_id
      type
      name
      product_attribute_items {
        display_value
        attribute_item_value
        attribute_item_id
      }
    }
  }
}
```

---

### Get product details

```graphql
query GetProduct($id: Int!) {
  product(id: $id) {
    id
    product_uid
    name
    in_stock
    category_name
    brand
    description
    product_gallery
    product_prices {
      amount
      currency_symbol
    }
    product_attributes {
      attribute_id
      type
      name
      product_attribute_items {
        display_value
        attribute_item_value
        attribute_item_id
      }
    }
  }
}
```

---

### Place order

```graphql
mutation PlaceOrder($items: [OrderItemInput!]!) {
  placeOrder(items: $items) {
    id
    total
    items {
      product_id
      qty
      price
      selected_options {
        name
        value
      }
    }
  }
}
```

---

## Notes

- The database is seeded with product data only
- Orders are created dynamically during runtime
- All data operations are handled via GraphQL
- Database relationships are enforced with foreign keys

## 📚 Additional Documentation

For more detailed information about the project architecture:

- Frontend documentation: ./client/README.md
- Backend documentation: ./server/README.md

---

## Author

Scandiweb Candidate — Sopo Bichinashvili
