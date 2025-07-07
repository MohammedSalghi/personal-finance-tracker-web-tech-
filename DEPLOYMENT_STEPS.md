# 🚀 Live Deployment Steps

## Step 1: Deploy Backend to Railway

### 1.1 Create Railway Account
1. Go to [railway.app](https://railway.app)
2. Click "Login" → "Sign up with GitHub"
3. Authorize Railway to access your GitHub

### 1.2 Create Project
1. Click "New Project"
2. Select "Deploy from GitHub repo"
3. Choose: `personal-finance-tracker-web-tech-group-recovry`
4. Railway will start building

### 1.3 Configure Backend Service
1. Click on your service (it will show as building)
2. Go to "Settings" tab
3. Set **Root Directory**: `finance-backend`
4. Click "Save"

### 1.4 Add MySQL Database
1. In project dashboard, click "New Service"
2. Select "Database" → "MySQL"
3. Railway will create MySQL instance
4. Note: Connection details are auto-generated

### 1.5 Import Database Schema
1. Connect to your MySQL database using provided credentials
2. Run the SQL from `finance-backend/personal_finance_tracker.sql`
3. Or use Railway's web interface to import the schema

### 1.6 Get Backend URL
1. Go to your backend service
2. Click on "Settings" → "Domains"
3. Railway will provide a URL like: `https://your-app.up.railway.app`
4. Test: `https://your-app.up.railway.app/health.php`

---

## Step 2: Deploy Frontend to Netlify

### 2.1 Create Netlify Account
1. Go to [netlify.com](https://netlify.com)
2. Click "Sign up" → "Sign up with GitHub"
3. Authorize Netlify

### 2.2 Create Site
1. Click "New site from Git"
2. Choose "GitHub"
3. Select: `personal-finance-tracker-web-tech-group-recovry`

### 2.3 Configure Build Settings
1. **Build command**: `npm run build:prod`
2. **Publish directory**: `dist`
3. **Base directory**: (leave empty)
4. Click "Deploy site"

### 2.4 Set Environment Variables
1. Go to "Site settings" → "Environment variables"
2. Add these variables:
   ```
   VUE_APP_API_BASE_URL = https://your-railway-url.up.railway.app/api/transactions
   VUE_APP_ENVIRONMENT = production
   NODE_ENV = production
   ```
3. Click "Save" then "Redeploy"

### 2.5 Get Frontend URL
1. Netlify will provide a URL like: `https://amazing-app-123.netlify.app`
2. Test your frontend at this URL

---

## Step 3: Update CORS Configuration

### 3.1 Update Backend CORS
1. Copy your Netlify URL
2. Update `finance-backend/config/cors.php`:
   ```php
   $allowedOrigins = [
       'https://your-actual-netlify-url.netlify.app',
       'https://localhost:8080',
       'http://localhost:8080'
   ];
   ```

### 3.2 Push Changes
1. Commit and push the CORS update
2. Railway will auto-redeploy your backend

---

## Step 4: Test Everything

### 4.1 Test Backend
- Health check: `https://your-railway-url.up.railway.app/health.php`
- Should return: `{"status": "healthy", "database": "connected"}`

### 4.2 Test Frontend
- Open: `https://your-netlify-url.netlify.app`
- Try adding a transaction
- Check if data loads properly

### 4.3 Test Full Flow
1. Add a transaction
2. Edit a transaction
3. Delete a transaction
4. Check balance calculation

---

## 🎯 Need Help?

If you get stuck at any step:
1. Check Railway logs for backend issues
2. Check Netlify logs for frontend issues
3. Check browser console for API errors
4. Verify environment variables are set correctly

Your database.php is already configured to work with Railway's environment variables! 🎉
