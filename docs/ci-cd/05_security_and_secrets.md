# Bonus: Security & Secrets

One of the most important parts of CI/CD is **Security**. You never want to put your passwords or SSH keys directly into your code.

### 1. What are GitHub Secrets?
GitHub Secrets are encrypted variables that you store in your repository settings. Only the GitHub Actions runner can "see" them when it's running your code.

### 2. How to use them:
In your code, you access them like this:
`${{ secrets.YOUR_SECRET_NAME }}`

### 3. Best Practices:
*   **Never Hardcode**: Even if it's a private repository, never put a password in a `.yml` file.
*   **Restrict Permissions**: Use a specific FTP user or SSH user that only has access to the folders needed for the website (e.g., `public_html`), not the whole server.
*   **Rotation**: Change your passwords/keys periodically for better security.

By using secrets, we ensured that even though your code is on GitHub, your server remains secure.
