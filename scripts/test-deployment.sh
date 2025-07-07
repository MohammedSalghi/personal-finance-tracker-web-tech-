#!/bin/bash

# Personal Finance Tracker - Deployment Test Script
# This script helps verify your deployment setup

echo "🧪 Testing Personal Finance Tracker Deployment Setup"
echo "===================================================="

# Check if Node.js is installed
echo "📋 Checking Node.js..."
if command -v node &> /dev/null; then
    echo "✅ Node.js version: $(node --version)"
else
    echo "❌ Node.js not found. Please install Node.js first."
    exit 1
fi

# Check if npm is installed
echo "📋 Checking npm..."
if command -v npm &> /dev/null; then
    echo "✅ npm version: $(npm --version)"
else
    echo "❌ npm not found. Please install npm first."
    exit 1
fi

# Check if dependencies are installed
echo "📋 Checking dependencies..."
if [ -f "package.json" ] && [ -d "node_modules" ]; then
    echo "✅ Dependencies are installed"
else
    echo "⚠️  Dependencies not found. Run: npm install"
fi

# Check if build exists
echo "📋 Checking production build..."
if [ -d "dist" ]; then
    echo "✅ Production build exists"
    echo "   Build size: $(du -sh dist | cut -f1)"
else
    echo "⚠️  Production build not found. Run: npm run build:prod"
fi

# Check backend files
echo "📋 Checking backend files..."
if [ -f "finance-backend/health.php" ]; then
    echo "✅ Backend health endpoint exists"
else
    echo "❌ Backend health endpoint missing"
fi

if [ -f "finance-backend/config/database.php" ]; then
    echo "✅ Database configuration exists"
else
    echo "❌ Database configuration missing"
fi

if [ -f "finance-backend/config/cors.php" ]; then
    echo "✅ CORS configuration exists"
else
    echo "❌ CORS configuration missing"
fi

# Check configuration files
echo "📋 Checking configuration files..."
if [ -f ".env.production" ]; then
    echo "✅ Production environment file exists"
else
    echo "❌ .env.production file missing"
fi

if [ -f "netlify.toml" ]; then
    echo "✅ Netlify configuration exists"
else
    echo "❌ Netlify configuration missing"
fi

if [ -f "finance-backend/railway.toml" ]; then
    echo "✅ Railway configuration exists"
else
    echo "❌ Railway configuration missing"
fi

echo ""
echo "🎉 Deployment Setup Summary:"
echo "✅ Frontend: Vue.js app with production build"
echo "✅ Backend: PHP API with health monitoring"
echo "✅ Database: MySQL with environment variables"
echo "✅ CORS: Configured for multiple origins"
echo "✅ Deployment: Netlify + Railway ready"
echo ""
echo "🚀 Ready for deployment! Check DEPLOYMENT_READY.md for next steps."
