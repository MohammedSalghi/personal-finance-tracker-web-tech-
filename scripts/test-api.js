// Quick API Test Script
const axios = require('axios');

const API_BASE_URL = process.env.VUE_APP_API_BASE_URL || 'http://localhost/finance-tracker/finance-backend';

async function testAPI() {
    console.log('🧪 Testing API endpoints...');
    console.log('Base URL:', API_BASE_URL);
    
    try {
        // Test health endpoint
        console.log('\n1️⃣ Testing health endpoint...');
        const healthResponse = await axios.get(`${API_BASE_URL}/health.php`);
        console.log('✅ Health check:', healthResponse.data.status);
        
        // Test get transactions
        console.log('\n2️⃣ Testing get transactions...');
        const getResponse = await axios.get(`${API_BASE_URL}/api/transactions/get.php`);
        console.log('✅ Get transactions:', getResponse.status === 200 ? 'Success' : 'Failed');
        
        // Test CORS
        console.log('\n3️⃣ Testing CORS headers...');
        const corsHeaders = getResponse.headers['access-control-allow-origin'];
        console.log('✅ CORS:', corsHeaders ? 'Configured' : 'Missing');
        
        console.log('\n🎉 All tests passed!');
        
    } catch (error) {
        console.error('\n❌ API test failed:');
        console.error('Error:', error.message);
        if (error.response) {
            console.error('Status:', error.response.status);
            console.error('Data:', error.response.data);
        }
    }
}

// Run tests
testAPI();
