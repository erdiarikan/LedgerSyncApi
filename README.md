LedgerSync - README

LedgerSync
==========

**LedgerSync** is a Laravel-based software that allows businesses to manage their financial data seamlessly by providing backup, restore, and migration functionalities for company accounts across multiple platforms.

Features
--------

*   **Backup and Restore:** Securely back up and restore company accounts.
*   **Ledger Migration:** Move ledgers between different platforms with ease.
*   **Xero Integration:** Fully integrated with Xero to manage ledgers and accounts.

Upcoming Features
-----------------

*   **QuickBooks Integration:** QuickBooks will be the next platform to be supported.

Installation
------------

Follow these steps to set up the project locally:

1.  **Clone the repository:**

        git clone https://github.com/your-username/LedgerSync.git
        cd LedgerSync

2.  **Install dependencies:**

        composer install
        npm install

3.  **Set up your environment:**
    *   Copy the `.env.example` file to `.env`:

            cp .env.example .env

    *   Update the `.env` file with your database credentials, Xero API keys, and other necessary configurations.
4.  **Run migrations:**

        ./migrate_fresh.sh

5.  **Start the development server:**

        php artisan serve

6.  **Build frontend assets:**

        npm run dev


Usage
-----

1.  Log in to the application.
2.  Connect your Xero account under the settings menu.
3.  Use the backup or restore functionality to manage your company’s accounts.
4.  Monitor migration logs to track the status of ledger transfers.

Contributing
------------

We welcome contributions! Here's how you can get involved:

1.  **Fork the repository**.
2.  **Create a feature branch** for your changes:

        git checkout -b feature/my-new-feature

3.  **Commit your changes**:

        git commit -m "Add my new feature"

4.  **Push to your branch**:

        git push origin feature/my-new-feature

5.  **Create a Pull Request** on GitHub.

Feel free to propose features, report bugs, or suggest enhancements via GitHub Issues.

## Project Information
You can find the database structure visually here: [dbdiagram](https://dbdiagram.io/d/LedgerSync-6742ca3ae9daa85aca80e459)

License
-------

This project is licensed under the [MIT License](LICENSE).

Roadmap
-------

*   **QuickBooks Integration:** Work is in progress to bring QuickBooks support.
*   **Sage Integration:** Future plans include integrating Sage accounting platform.
*   **Improved Reporting:** Enhancements for reporting and analytics.

Support
-------

If you encounter issues or have questions, please open a GitHub Issue or reach out to the maintainers.

* * *

Happy coding! 🚀
