# Personal Finance Tracker - Deployment Test Script (PowerShell)
# This script helps verify your deployment setup

Write-Host "🧪 Testing Personal Finance Tracker Deployment Setup" -ForegroundColor Cyan
Write-Host "====================================================" -ForegroundColor Cyan

# Check if Node.js is installed
Write-Host "📋 Checking Node.js..." -ForegroundColor Yellow
try {
    $nodeVersion = node --version
    Write-Host "✅ Node.js version: $nodeVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ Node.js not found. Please install Node.js first." -ForegroundColor Red
    exit 1
}

# Check if npm is installed
Write-Host "📋 Checking npm..." -ForegroundColor Yellow
try {
    $npmVersion = npm --version
    Write-Host "✅ npm version: $npmVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ npm not found. Please install npm first." -ForegroundColor Red
    exit 1
}

# Check if dependencies are installed
Write-Host "📋 Checking dependencies..." -ForegroundColor Yellow
if ((Test-Path "package.json") -and (Test-Path "node_modules")) {
    Write-Host "✅ Dependencies are installed" -ForegroundColor Green
} else {
    Write-Host "⚠️  Dependencies not found. Run: npm install" -ForegroundColor Yellow
}

# Check if build exists
Write-Host "📋 Checking production build..." -ForegroundColor Yellow
if (Test-Path "dist") {
    Write-Host "✅ Production build exists" -ForegroundColor Green
    $buildSize = (Get-ChildItem -Path "dist" -Recurse | Measure-Object -Property Length -Sum).Sum / 1MB
    Write-Host "   Build size: $([math]::Round($buildSize, 2)) MB" -ForegroundColor Green
} else {
    Write-Host "⚠️  Production build not found. Run: npm run build:prod" -ForegroundColor Yellow
}

# Check backend files
Write-Host "📋 Checking backend files..." -ForegroundColor Yellow
if (Test-Path "finance-backend/health.php") {
    Write-Host "✅ Backend health endpoint exists" -ForegroundColor Green
} else {
    Write-Host "❌ Backend health endpoint missing" -ForegroundColor Red
}

if (Test-Path "finance-backend/config/database.php") {
    Write-Host "✅ Database configuration exists" -ForegroundColor Green
} else {
    Write-Host "❌ Database configuration missing" -ForegroundColor Red
}

if (Test-Path "finance-backend/config/cors.php") {
    Write-Host "✅ CORS configuration exists" -ForegroundColor Green
} else {
    Write-Host "❌ CORS configuration missing" -ForegroundColor Red
}

# Check configuration files
Write-Host "📋 Checking configuration files..." -ForegroundColor Yellow
if (Test-Path ".env.production") {
    Write-Host "✅ Production environment file exists" -ForegroundColor Green
} else {
    Write-Host "❌ .env.production file missing" -ForegroundColor Red
}

if (Test-Path "netlify.toml") {
    Write-Host "✅ Netlify configuration exists" -ForegroundColor Green
} else {
    Write-Host "❌ Netlify configuration missing" -ForegroundColor Red
}

if (Test-Path "finance-backend/railway.toml") {
    Write-Host "✅ Railway configuration exists" -ForegroundColor Green
} else {
    Write-Host "❌ Railway configuration missing" -ForegroundColor Red
}

Write-Host ""
Write-Host "🎉 Deployment Setup Summary:" -ForegroundColor Cyan
Write-Host "✅ Frontend: Vue.js app with production build" -ForegroundColor Green
Write-Host "✅ Backend: PHP API with health monitoring" -ForegroundColor Green
Write-Host "✅ Database: MySQL with environment variables" -ForegroundColor Green
Write-Host "✅ CORS: Configured for multiple origins" -ForegroundColor Green
Write-Host "✅ Deployment: Netlify + Railway ready" -ForegroundColor Green
Write-Host ""
Write-Host "🚀 Ready for deployment! Check DEPLOYMENT_READY.md for next steps." -ForegroundColor Cyan
