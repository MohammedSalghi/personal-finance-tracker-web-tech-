# 🚀 DEPLOY NOW - Personal Finance Tracker

## ✅ Status: READY FOR DEPLOYMENT

Your application is fully configured and ready to deploy. Here's your step-by-step deployment guide:

---

## 🎯 **STEP 1: Deploy Backend to Railway**

### 1.1 Sign up and create project
- Go to [railway.app](https://railway.app)
- Sign up with GitHub
- Click "New Project" → "Deploy from GitHub repo"
- Select your repository: `personal-finance-tracker-web-tech-group-recovry`

### 1.2 Configure Railway deployment
- Set **Root Directory**: `finance-backend`
- Railway will auto-detect PHP
- Click "Deploy"

### 1.3 Add MySQL database
- In your Railway project dashboard
- Click "New Service" → "Database" → "MySQL"
- Note the connection details (auto-generated)

### 1.4 Set environment variables
Go to your backend service → Variables tab, add:
```
DB_HOST=<your-mysql-host>
DB_PORT=<your-mysql-port>
DB_DATABASE=<your-mysql-database>
DB_USERNAME=<your-mysql-username>
DB_PASSWORD=<your-mysql-password>
```

### 1.5 Import database schema
- Connect to your MySQL database
- Run the SQL from `finance-backend/personal_finance_tracker.sql`

### 1.6 Get your backend URL
- Copy your Railway backend URL (e.g., `https://your-app.up.railway.app`)
- Test health endpoint: `https://your-app.up.railway.app/health.php`

---

## 🎯 **STEP 2: Deploy Frontend to Netlify**

### 2.1 Sign up and create site
- Go to [netlify.com](https://netlify.com)
- Sign up with GitHub
- Click "New site from Git"
- Select your repository

### 2.2 Configure build settings
- **Build command**: `npm run build:prod`
- **Publish directory**: `dist`
- **Base directory**: (leave empty)

### 2.3 Set environment variables
Go to Site settings → Environment variables, add:
```
VUE_APP_API_BASE_URL=https://your-railway-url.up.railway.app/api/transactions
VUE_APP_ENVIRONMENT=production
NODE_ENV=production
```

### 2.4 Deploy and get URL
- Click "Deploy site"
- Note your Netlify URL (e.g., `https://amazing-app-123.netlify.app`)

---

## 🎯 **STEP 3: Update CORS Configuration**

### 3.1 Update backend CORS
Once you have your Netlify URL, update the CORS configuration:

In `finance-backend/config/cors.php`, replace the allowed origins with your actual Netlify URL:
```php
$allowedOrigins = [
    'https://your-actual-netlify-url.netlify.app',
    'https://localhost:8080',
    'http://localhost:8080'
];
```

### 3.2 Redeploy backend
- Push the CORS update to GitHub
- Railway will auto-redeploy

---

## 🎯 **STEP 4: Test Everything**

### 4.1 Test endpoints
- Backend health: `https://your-railway-url.up.railway.app/health.php`
- Frontend: `https://your-netlify-url.netlify.app`

### 4.2 Test full functionality
1. Open your Netlify URL
2. Try adding a transaction
3. Check if transactions load
4. Verify all CRUD operations work

---

## 🛠️ **Troubleshooting**

### Common Issues:
1. **CORS Error**: Update `cors.php` with correct Netlify URL
2. **Database Connection**: Check Railway environment variables
3. **Build Failure**: Ensure `npm run build:prod` works locally
4. **404 Errors**: Check `_redirects` file in `dist` folder

### Debug Tools:
- Railway logs: Check your service logs
- Netlify logs: Check function logs and deploy logs
- Browser console: Check for API call errors

---

## 🎉 **You're Ready!**

Your Personal Finance Tracker is configured for:
- ✅ Vue.js frontend with production build
- ✅ PHP backend with health monitoring
- ✅ MySQL database with environment variables
- ✅ CORS configured for production
- ✅ Automatic deployments from GitHub

**Next**: Follow the steps above to deploy to Railway + Netlify!

---

## 📞 **Need Help?**

If you encounter any issues:
1. Check the logs in Railway/Netlify dashboards
2. Verify environment variables are set correctly
3. Test the health endpoint first
4. Ensure database schema is imported

Good luck with your deployment! 🚀
