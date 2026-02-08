# Step 2: The SSH Pivot & Cloudflare Obstacle

After checking your GitHub repository, we found existing **SSH secrets** (`SSH_HOST`, `SSH_USER`, `SSH_KEY`). We decided to pivot to SSH because it's usually faster and more secure.

### The SSH Workflow
Instead of uploading files, this workflow logs into your server and runs a command.

```yaml
name: Deploy to cPanel (SSH Version)
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Execute remote git pull
        uses: appleboy/ssh-action@v1.0.3
        with:
          host: ${{ secrets.SSH_HOST }}
          username: ${{ secrets.SSH_USER }}
          key: ${{ secrets.SSH_KEY }}
          script: |
            cd ${{ secrets.DEPLOY_PATH }}
            git pull origin main
```

### The "Cloudflare" Wall:
When we ran this, we got this error:
`dial tcp 104.21.78.9:22: i/o timeout`

**What happened?**
1.  The IP `104.21.78.9` belongs to **Cloudflare**.
2.  Cloudflare is a "Proxy". It only lets Web Traffic (Port 80/443) through.
3.  It **blocks** SSH (Port 22) and FTP (Port 21) traffic by default.

This is a classic CI/CD obstacle! To fix it, you cannot use your domain name as the host; you must use the **direct server IP**.
