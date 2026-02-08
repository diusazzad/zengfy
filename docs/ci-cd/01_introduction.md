# Introduction to CI/CD for ZenGfy

Welcome to your CI/CD learning guide. CI/CD stands for **Continuous Integration and Continuous Deployment**.

### What we achieved:
We moved from a **manual** process (manually pulling code in cPanel) to a **fully automated** one. Now, every time you push code to GitHub, your website updates itself.

### The Journey:
Learning CI/CD is often about troubleshooting. We went through three main versions of the workflow:
1.  **Version 1 (FTP)**: Using cPanel FTP credentials.
2.  **Version 2 (SSH)**: Using secure shell access to run `git pull`.
3.  **Version 3 (The Fix)**: Dealing with Cloudflare proxy issues by using a Direct IP.

Explore the folders in this directory to see the code and logic for each step.
