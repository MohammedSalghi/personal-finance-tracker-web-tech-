# Personal Finance Tracker - Easy Deployment Guide

## 🚀 Successfully Deployed Application

**Frontend**: [https://personal-finance-tracker-web-tech-vert.vercel.app](https://personal-finance-tracker-web-tech-vert.vercel.app)  
**Backend**: [https://personal-finance-tracker-web-tech-b6jl.onrender.com](https://personal-finance-tracker-web-tech-b6jl.onrender.com)  
**GitHub**: [https://github.com/MohammedSalghi/personal-finance-tracker-web-tech-](https://github.com/MohammedSalghi/personal-finance-tracker-web-tech-)

## 📋 Quick Status Check

### ✅ DEPLOYMENT COMPLETE!
- [x] Frontend deployed to Vercel
- [x] Backend deployed to Render with Docker
- [x] PostgreSQL database created on Render
- [x] Environment variables configured
- [x] CORS properly configured
- [x] All code pushed to GitHub
- [x] Database table created successfully! ✅

### 🎉 **YOUR APP IS NOW LIVE AND WORKING!**

**You're now connected to PostgreSQL! Follow these commands:**

## 🔧 STEP-BY-STEP: Create Table in psql

**Since you're already connected to PostgreSQL via psql, follow these exact steps:**

### Step 1: Find Your psql Window
- Look for your terminal/command prompt window
- You should see a prompt like: `dpg-d1lvitfdees7387kv50-a=>` or `postgres=>`

### Step 2: Copy This SQL Command
```sql
CREATE TABLE transactions (
    id SERIAL PRIMARY KEY,
    type VARCHAR(10) NOT NULL CHECK (type IN ('income', 'expense')),
    amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),
    category VARCHAR(50) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Step 3: Paste and Execute
1. **Click** in your psql window (where you see the `=>` prompt)
2. **Right-click** and select "Paste" (or press Ctrl+V)
3. **Press Enter** to execute
4. You should see: `CREATE TABLE` as confirmation

### Step 4: Verify Table Creation
Type this command and press Enter:
```sql
\dt
```
You should see `transactions` in the list of tables.

### Step 5: Test with Sample Data (Optional)
```sql
INSERT INTO transactions (type, amount, category, description, date) 
VALUES ('income', 1000.00, 'salary', 'Test transaction', CURRENT_DATE);

SELECT * FROM transactions;
```

### Step 6: Exit psql
When done, type:
```sql
\q
```

---

## 🔧 Alternative Methods (if psql doesn't work)

#### Method 1: Using DBeaver (Free GUI Tool - RECOMMENDED)

**Note**: Render's Web Shell requires a paid plan. DBeaver is the easiest free option.

1. **Download DBeaver**:
   - Go to [DBeaver.io](https://dbeaver.io/download/)
   - Download "Community Edition" (free)
   - Install and open DBeaver

2. **Get Connection Details from Render**:
   - In Render dashboard → Database → Connect → "External Connection"
   - Copy: Host, Database, Username, Password, Port

3. **Connect to Database**:
   - In DBeaver: New Database Connection → PostgreSQL
   - Fill in the connection details from Render
   - Test connection and click "Finish"

4. **Execute SQL**:
   - Right-click your database → "SQL Editor" → "Open SQL Script"
   - Paste this command:
   ```sql
   CREATE TABLE transactions (
       id SERIAL PRIMARY KEY,
       type VARCHAR(10) NOT NULL CHECK (type IN ('income', 'expense')),
       amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),
       category VARCHAR(50) NOT NULL,
       description TEXT,
       date DATE NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```
   - Click "Execute" button or press Ctrl+Enter

5. **Verify the Import**:
   ```sql
   SELECT * FROM transactions;
   ```

#### Method 2: Using psql Command Line

1. **Get Connection Details**:
   - In Render dashboard → Database → Connect
   - Copy the "External Connection" details

2. **Connect via Command Line**:
   ```bash
   # Install psql if not installed
   # On Windows: Download PostgreSQL from postgresql.org
   
   # Connect to your database
   psql -h <hostname> -U <username> -d <database_name> -p 5432
   ```

3. **Run the Schema**:
   ```sql
   CREATE TABLE transactions (
       id SERIAL PRIMARY KEY,
       type VARCHAR(10) NOT NULL CHECK (type IN ('income', 'expense')),
       amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),
       category VARCHAR(50) NOT NULL,
       description TEXT,
       date DATE NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

#### Method 2: Using pgAdmin (GUI Tool)

1. **Download pgAdmin**:
   - Go to [pgAdmin.org](https://www.pgadmin.org/download/)
   - Download and install pgAdmin

2. **Connect to Database**:
   - Open pgAdmin
   - Right-click "Servers" → "Create" → "Server"
   - **General Tab**: Name: "Render Database"
   - **Connection Tab**: Fill in details from Render dashboard
   - Test connection and save

3. **Run Query**:
   - Right-click your database → "Query Tool"
   - Paste and execute the CREATE TABLE command

#### Method 3: Using psql Command Line

1. **Install PostgreSQL Tools**:
   - Download PostgreSQL from [postgresql.org](https://www.postgresql.org/download/windows/)
   - During installation, make sure to include "pgAdmin 4" and "Command Line Tools"

2. **Get Connection Details**:
   - In Render dashboard → Database → Connect → "External Connection"
   - Copy all connection details

3. **Connect via Command Line**:
   ```powershell
   # Open PowerShell and run:
   psql -h <hostname> -U <username> -d <database_name> -p 5432
   # Enter password when prompted
   ```

4. **Run the Schema**:
   ```sql
   CREATE TABLE transactions (
       id SERIAL PRIMARY KEY,
       type VARCHAR(10) NOT NULL CHECK (type IN ('income', 'expense')),
       amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),
       category VARCHAR(50) NOT NULL,
       description TEXT,
       date DATE NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

#### Method 4: Using Online PostgreSQL Client

1. **Use adminer.org**:
   - Go to [adminer.org](https://www.adminer.org/)
   - Click "Download" and get the PHP file
   - Upload to any web server or use online version

2. **Connect**:
   - System: PostgreSQL
   - Server: Your Render hostname
   - Username, Password, Database: From Render dashboard

3. **Execute SQL**:
   - Go to "SQL command" tab
   - Paste and execute the CREATE TABLE command

#### Quick Test After Import

Run this to verify everything works:
```sql
-- Insert test data
INSERT INTO transactions (type, amount, category, description, date) 
VALUES ('income', 1000.00, 'salary', 'Monthly salary', CURRENT_DATE);

-- Check if it worked
SELECT * FROM transactions;
```

## 🌐 Environment Variables

### Vercel (Frontend)
```
VUE_APP_API_BASE_URL=https://personal-finance-tracker-web-tech-b6jl.onrender.com
VUE_APP_ENVIRONMENT=production
```

### Render (Backend)
```
DB_HOST=<your-render-postgres-host>
DB_NAME=<your-database-name>
DB_USER=<your-username>
DB_PASSWORD=<your-password>
DB_PORT=5432
DATABASE_URL=<full-postgres-connection-string>
```

## 📁 Project Structure

```
personal-finance-tracker/
├── frontend/                # Vue.js frontend
│   ├── src/
│   ├── public/
│   └── package.json
├── finance-backend/         # PHP backend
│   ├── api/
│   ├── config/
│   ├── models/
│   ├── Dockerfile
│   └── health.php
└── netlify/                 # Serverless functions (backup)
```

## 🔄 Deployment Process

### 1. Code Changes
```bash
# Make your changes
git add .
git commit -m "Your changes"
git push origin main
```

### 2. Auto-Deploy
- **Vercel**: Automatically deploys on git push
- **Render**: Automatically rebuilds and deploys on git push

### 3. Manual Deploy (if needed)
- **Vercel**: Go to dashboard → Deployments → Redeploy
- **Render**: Go to dashboard → Manual Deploy

## 🐛 Troubleshooting

### Common Issues

1. **"Network error: Could not save to shared database"**
   - **Solution**: Import the SQL schema (see Final Setup Step above)

2. **CORS errors**
   - **Solution**: Already configured in `finance-backend/config/cors.php`

3. **Database connection issues**
   - **Solution**: Check environment variables in Render dashboard

4. **Backend not responding**
   - **Solution**: Check logs in Render dashboard

### Health Check URLs
- Backend Health: `https://personal-finance-tracker-web-tech-b6jl.onrender.com/health.php`
- API Test: `https://personal-finance-tracker-web-tech-b6jl.onrender.com/api/transactions/`

## 🔧 Key Files

### Backend Configuration
- `finance-backend/config/database.php` - Database connection
- `finance-backend/config/cors.php` - CORS settings
- `finance-backend/Dockerfile` - Docker configuration
- `finance-backend/health.php` - Health check endpoint

### Frontend Configuration
- `frontend/src/config/api.js` - API endpoints
- `frontend/vue.config.js` - Build configuration

## 📈 Performance Notes

- **Backend**: Render free tier may sleep after 15 minutes of inactivity
- **Frontend**: Vercel provides excellent performance with CDN
- **Database**: PostgreSQL on Render with connection pooling

## 🎯 Next Steps

1. **Complete the final setup** by importing the SQL schema
2. **Test all functionality** through the live frontend
3. **Monitor performance** through Render and Vercel dashboards
4. **Set up monitoring** for production use

## 🚀 Success Metrics

Once the SQL schema is imported, you should be able to:
- ✅ Add new transactions
- ✅ View all transactions
- ✅ Filter by type (income/expense)
- ✅ Calculate totals and balance
- ✅ Access from any device via the public URL

---

**Last Updated**: $(date)  
**Status**: Ready for final database setup  
**Version**: 1.0.0
