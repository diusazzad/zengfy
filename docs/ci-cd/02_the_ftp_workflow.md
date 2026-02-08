# Step 1: The FTP Workflow

The first approach we planned was using **FTP (File Transfer Protocol)**. This is the most common way to push files to cPanel.

### The Workflow File (`.github/workflows/deploy.yml`)
In this version, we use the `FTP-Deploy-Action`.

```yaml
name: Deploy to cPanel (FTP Version)
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Sync files
        uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
          server: ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          server-dir: public_html/
```

### Why we used this:
*   It's simple to set up if you have FTP accounts in cPanel.
*   It tracks which files have changed and only uploads the new ones.

### The Problem:
This version failed initially because `FTP_SERVER` was set to `zengfy.top`. Since `zengfy.top` is behind **Cloudflare**, the connection was blocked. We solved this in Step 3!
