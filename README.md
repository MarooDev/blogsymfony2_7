# Symfony 2.7 Docker Starter

This project contains only the Docker configuration for running a legacy Symfony 2.7 application with PHP 5.6 and Apache.

## How to run

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   ```

2. **Add your Symfony 2.7 project files**  
   Place your Symfony 2.7 application files in this directory.

3. **Build the Docker image:**
   ```bash
   docker compose build
   ```

4. **Start the container:**
   ```bash
   docker compose up -d
   ```

5. **Install PHP dependencies (Composer):**
   ```bash
   docker compose exec app composer install
   ```
   This will create the `vendor` directory and generate required cache files.

6. **Set permissions for cache and logs directories:**
   ```bash
   docker compose exec app chown -R www-data:www-data app/cache app/logs
   docker compose exec app chmod -R 755 app/cache app/logs
   ```

7. **Access the application:**  
   Open [http://localhost:8080](http://localhost:8080) in your browser.

8. **Set PHP timezone (optional but recommended):**
   Add to your Symfony `app/config/parameters.yml`:
   ```yaml
   parameters:
     date_timezone: Europe/Warsaw
   ```

   Or set in your code (e.g. in `app/AppKernel.php`):
   ```php
   date_default_timezone_set('Europe/Warsaw');
   ```

## Using phpMyAdmin

After starting the containers, phpMyAdmin will be available at [http://localhost:8081](http://localhost:8081).

**Login instructions:**
- Use the credentials and server name defined in your `.env` file.

**Importing your database:**
- After logging in, use the "Import" tab in phpMyAdmin to upload your `.sql` file (e.g. `symfony27.sql`) and create the necessary tables

## Notes

- The container uses PHP 5.6 and Apache.
- Your project files are mounted into `/var/www/html` inside the container.
- For Composer support, Composer is installed in the container and you should run `composer install` after starting the container.
- Make sure your Symfony project contains a valid `composer.json` file.

---
**English comments are used in configuration files. For help, contact the repository maintainer.**
