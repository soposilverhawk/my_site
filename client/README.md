# Scandiweb E-Commerce Project — Frontend Documentation

## Overview

This frontend is part of a full-stack e-commerce application built for the Scandiweb assessment. It is built with React and communicates with a PHP GraphQL backend to handle product data, cart state, and order placement.

The application supports product browsing, category filtering, product detail views, attribute selection, cart management, and order placement.

---

## Technologies & Libraries

### Core Technologies

- React.js
- JavaScript (ES6+)

### Architecture Patterns

- Component-based architecture
- Context API for global state management
- Custom hooks for reusable logic
- Utility-based helper functions

### Libraries

- React Router — client-side routing
- styled-components — component-level styling
- @apollo/client — GraphQL client for API communication
- html-react-parser — rendering HTML content from backend
- dompurify — sanitizing backend HTML to prevent XSS attacks

---

## Features

- Product listing by category (All, Clothes, Tech)
- Product detail page with attribute selection
- Add-to-cart functionality with variant support
- Cart management (quantity updates and item removal)
- Order placement through GraphQL mutations
- Persistent cart and order data via backend API
- Responsive UI optimized for mobile as a bonus to base project requirements

---

## Project Structure

```
/public -> Static assets (favicon, images not used in UI)
/src/api -> GraphQL queries and mutations
/src/components -> Reusable UI components
/src/components/Shared -> Shared layout components (header, layout wrappers)
/src/context -> Global state management (cart, UI state)
/src/hooks -> Custom reusable hooks
/src/pages -> Page-level components (routes)
/src/routes -> Application routing configuration
/src/utils -> Helper and utility functions
App.jsx -> Root application component
main.jsx -> Apollo Client setup, routing, and app bootstrap
App.css -> Global styles and variables
index.css -> CSS reset and base styles
```

---

## Data Flow

The frontend follows a unidirectional data flow pattern:

1. User interacts with UI components
2. Apollo Client sends GraphQL queries/mutations to the backend
3. Backend resolves requests and returns structured data
4. Data is normalized and consumed by React components
5. Context and hooks manage shared state (e.g. cart)
6. UI updates automatically based on state changes

---

## State Management Overview

- Cart state is managed globally using Context API
- Product selection state is handled locally per component
- Apollo Client manages server state (GraphQL cache)
- Custom hooks abstract repeated logic (e.g. cart operations, data fetching)

---

## Summary

The frontend is designed as a modular and scalable React application with a clear separation between UI, state management, and API communication layers. It is fully integrated with a GraphQL backend and structured to support maintainability and extension.
