# Browser & Console Error Debugging Checklist

When you face any error in the browser or console, follow these steps one by one to break it down and fix it:

## 1. PHP/Server Errors (500 Server Error)
- [ ] **Check the exact Error Message:** Read the very first line of the error. What does it say? (e.g., `ParseError`, `TypeError`, `QueryException`).
- [ ] **Find the File & Line Number:** Look for the file path and line number in the stack trace. This tells you exactly where the code crashed.
- [ ] **Check for Syntax Mistakes:** Go to that line and check for missing semicolons `;`, braces `}`, or commas `,`.
- [ ] **Clear Laravel Caches:** Run `php artisan optimize:clear` to make sure it's not a cached error.
- [ ] **Restart Local Server:** If the error still shows up after fixing the code, stop the server (`Ctrl + C`) and restart it (`php artisan serve` or Octane/Laragon restart). This clears the RAM/OPcache!

## 2. Browser Console Errors (Frontend / JS)
- [ ] **Open Developer Tools:** Press `F12` or `Right Click > Inspect` and go to the **Console** tab.
- [ ] **Read the Red Text:** Look for the red error message (e.g., `Uncaught ReferenceError: variable is not defined`).
- [ ] **Check the File Link:** On the right side of the error in the console, click the file link (e.g., `app.js:45`). It will take you to the exact line in the Source tab.
- [ ] **Network Tab Check:** Go to the **Network** tab, refresh the page, and look for any requests that are marked in red (404 Not Found, 500 Server Error).
- [ ] **Check API Responses:** Click on the failed Network request, then click the **Preview** or **Response** tab to see what the server actually returned.

## 3. General Best Practices
- [ ] **Check `laravel.log`:** Always check `storage/logs/laravel.log` (tail the last 50 lines) for backend errors that don't show up in the browser.
- [ ] **Dump and Die (dd):** Use `dd($variable);` in your PHP code to see what data is passing through at a specific point.
- [ ] **Console.log:** Use `console.log(variable);` in JavaScript to verify frontend data.
