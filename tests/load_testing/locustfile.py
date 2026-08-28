import uuid
import random
from locust import HttpUser, task, between


class RegistrationBotUser(HttpUser):
    # Each simulated bot will wait between 0.1 to 0.5 seconds between requests
    wait_time = between(0.1, 0.5)

    @task(3)
    def register_new_user(self):
        """Simulate a unique legit user registration"""
        random_id = str(uuid.uuid4())[:8]
        payload = {
            "name": f"Bot User {random_id}",
            "email": f"bot_{random_id}_{random.randint(1000, 999999)}@zengfy.test",
            "password": "SecurePassword123!",
        }
        headers = {
            "X-Idempotency-Key": str(uuid.uuid4()),
            "Accept": "application/json",
            "Content-Type": "application/json",
        }

        # Hit through the Nginx Load Balancer
        with self.client.post(
            "/api/v1/auth/register", json=payload, headers=headers, catch_response=True
        ) as response:
            if response.status_code in [200, 201]:
                response.success()
            elif response.status_code == 429:
                # Rate limited properly
                response.success()
            else:
                response.failure(f"Unexpected response code: {response.status_code}")

    @task(1)
    def simulate_rate_limit_attack(self):
        """Simulate spam attack from same bot to test rate limiting (HTTP 429)"""
        payload = {
            "name": "Spam Bot",
            "email": "spambot@zengfy.test",
            "password": "SecurePassword123!",
        }
        headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
        }
        self.client.post("/api/v1/auth/register", json=payload, headers=headers)
