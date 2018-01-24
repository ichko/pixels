# The Joy of Painting
On the HTML canvas :D

# About
This repository contains project written in for the 2018 WEB course in FMI.
The web site is `simpler` version of codepen (or whatever online editor).
You can register login and create `snippets` of code that `paints` on the canvas element.

---

The focus of the project was to make PHP MVC framework and `snippets` web site is just some
example build on top of it.

# Content
 - The framework
  - Dependency injection container
  - Template renderer
  - Validator
  - View renderer

 - The services for the website
  - Authentication (Registration/Login/Logout)
  - User input sanitization and extraction
  - Session manager
  - Navigator
  - Snippets manager

# Install
 - Place in root of PHP server
 - Configure the database from - config/db_config.php
 - Execute localhost/config/install.php - To install the DB
 - Execute localhost/config/seed.php - For simple seed (optional)
 - Navigate to localhost
 - You are done :)

# External Libs
 - [Ace Code Editor](https://ace.c9.io/)