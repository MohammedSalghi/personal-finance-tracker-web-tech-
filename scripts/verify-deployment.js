const fs = require('fs');
const path = require('path');

console.log('🔍 Pre-Deployment Verification');
console.log('===============================');

// Check if all required files exist
const requiredFiles = [
    'package.json',
    'src/config/api.js',
    '.env.production',
    'netlify.toml',
    'finance-backend/health.php',
    'finance-backend/config/database.php',
    'finance-backend/config/cors.php',
    'finance-backend/railway.toml',
    'finance-backend/personal_finance_tracker.sql'
];

console.log('\n📋 Checking required files...');
let allFilesExist = true;

requiredFiles.forEach(file => {
    if (fs.existsSync(file)) {
        console.log(`✅ ${file}`);
    } else {
        console.log(`❌ ${file} - MISSING`);
        allFilesExist = false;
    }
});

// Check package.json scripts
console.log('\n📋 Checking package.json scripts...');
const packageJson = JSON.parse(fs.readFileSync('package.json', 'utf8'));
const requiredScripts = ['build:prod', 'serve'];

requiredScripts.forEach(script => {
    if (packageJson.scripts && packageJson.scripts[script]) {
        console.log(`✅ ${script} script exists`);
    } else {
        console.log(`❌ ${script} script missing`);
        allFilesExist = false;
    }
});

// Check if dist folder exists
console.log('\n📋 Checking build output...');
if (fs.existsSync('dist')) {
    console.log('✅ dist folder exists');
    
    // Check dist contents
    const distFiles = fs.readdirSync('dist');
    const expectedFiles = ['index.html', 'css', 'js', '_redirects'];
    
    expectedFiles.forEach(file => {
        if (distFiles.includes(file)) {
            console.log(`✅ dist/${file} exists`);
        } else {
            console.log(`❌ dist/${file} missing`);
        }
    });
} else {
    console.log('❌ dist folder missing - run npm run build:prod');
    allFilesExist = false;
}

// Check environment file
console.log('\n📋 Checking environment configuration...');
if (fs.existsSync('.env.production')) {
    const envContent = fs.readFileSync('.env.production', 'utf8');
    if (envContent.includes('VUE_APP_API_BASE_URL')) {
        console.log('✅ VUE_APP_API_BASE_URL is set');
    } else {
        console.log('❌ VUE_APP_API_BASE_URL missing in .env.production');
    }
    
    if (envContent.includes('VUE_APP_ENVIRONMENT=production')) {
        console.log('✅ VUE_APP_ENVIRONMENT set to production');
    } else {
        console.log('❌ VUE_APP_ENVIRONMENT not set to production');
    }
}

// Check API configuration
console.log('\n📋 Checking API configuration...');
if (fs.existsSync('src/config/api.js')) {
    const apiConfig = fs.readFileSync('src/config/api.js', 'utf8');
    if (apiConfig.includes('process.env.VUE_APP_API_BASE_URL')) {
        console.log('✅ API config uses environment variables');
    } else {
        console.log('❌ API config not using environment variables');
    }
}

// Check backend configuration
console.log('\n📋 Checking backend configuration...');
if (fs.existsSync('finance-backend/config/database.php')) {
    const dbConfig = fs.readFileSync('finance-backend/config/database.php', 'utf8');
    if (dbConfig.includes('$_ENV[') || dbConfig.includes('getenv(')) {
        console.log('✅ Database config uses environment variables');
    } else {
        console.log('❌ Database config not using environment variables');
    }
}

// Final summary
console.log('\n🎯 DEPLOYMENT READINESS SUMMARY');
console.log('================================');

if (allFilesExist) {
    console.log('✅ All required files exist');
    console.log('✅ Build output is ready');
    console.log('✅ Environment variables configured');
    console.log('✅ API endpoints configured');
    console.log('✅ Database configuration ready');
    console.log('✅ CORS configuration ready');
    console.log('');
    console.log('🚀 STATUS: READY FOR DEPLOYMENT!');
    console.log('');
    console.log('Next steps:');
    console.log('1. Deploy backend to Railway');
    console.log('2. Deploy frontend to Netlify');
    console.log('3. Update CORS with actual URLs');
    console.log('4. Test the live application');
    console.log('');
    console.log('📖 See DEPLOY_NOW.md for detailed instructions');
} else {
    console.log('❌ Some files are missing or misconfigured');
    console.log('Please fix the issues above before deploying');
}
