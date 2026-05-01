# Scandiweb E-Commerce Project — Backend Documentation

## Overview

This backend is part of a full-stack e-commerce application built for the Scandiweb assessment. It is implemented in PHP and exposes a GraphQL API for communication with the React frontend.

The architecture follows an object-oriented design with strict separation of concerns. Business logic, database access, and GraphQL resolution layers are isolated using patterns such as Repository and Factory. Procedural code is limited to application bootstrap and database seeding.

---

## Core Principles

The backend is designed with the following principles:

- Fully object-oriented architecture
- Separation of concerns across layers (Controllers, Services, Repositories)
- Database abstraction using repositories and PDO
- Scalable GraphQL schema design
- Environment-based configuration

---

## Technologies & Tools

### Language & Standards

- PHP 8.2+
- PSR-1, PSR-4, PSR-12 compliance

### Architecture

- Object-Oriented Programming (OOP)
- Repository Pattern
- Factory Pattern
- Service Layer Architecture

### API Layer

- GraphQL (via `webonyx/graphql-php`)

### Database

- MySQL (MariaDB-compatible)
- PDO for secure database interaction
- Relational schema with foreign key constraints

### Tooling

- Composer (autoloading & dependency management)
- vlucas/phpdotenv (environment configuration)

---

## Features

- GraphQL API for products, categories, and attributes
- Category-based product retrieval
- Detailed product information (gallery, pricing, attributes)
- Attribute system (text & swatch types)
- Cart-related order persistence
- Structured relational data access

---

## Project Structure

```
/bin/import.php               -> Database initial seeding script 
/data/products.json           -> Source dataset provided by Scandiweb
/public/index.php             -> Application entry point

/src/Core                     -> Database connection (PDO)
/src/Models                   -> Domain models with inheritance structure
/src/Factories                -> Object creation and type resolution logic
/src/Repositories             -> Database access layer (CRUD operations)
/src/Services                 -> Business logic and import services

/src/GraphQL/Schema           -> GraphQL schema definition
/src/GraphQL/Types            -> GraphQL type definitions
/src/GraphQL/Resolvers        -> Query and mutation resolvers
/src/GraphQL/Queries          -> Query implementations
/src/GraphQL/Mutations        -> Mutation implementations
/src/GraphQL/ResolverFactory  -> Dependency injection for resolvers

/src/Controller               -> HTTP entry point for GraphQL requests
/src/Transformers             -> Data transformation utilities

composer.json                 -> Dependencies and autoload configuration
```

---

## Data Flow

The backend follows a layered request lifecycle:

1. Frontend sends a GraphQL request via Apollo Client
2. Request is received by the GraphQL controller
3. The appropriate resolver is invoked
4. Resolver delegates logic to services or repositories
5. Repository interacts with the MySQL database via PDO
6. Data is returned through the GraphQL layer
7. The frontend receives a structured response

---

## Architecture Notes

- Repositories isolate all database queries from business logic
- Services handle domain-specific operations
- Factories resolve and construct complex model instances
- GraphQL resolvers act as the entry point for all API operations
- Environment variables are used for all sensitive configuration

---

## Summary

This backend is designed to be modular, scalable, and maintainable. It cleanly separates concerns across layers and provides a structured GraphQL API for the frontend application.
