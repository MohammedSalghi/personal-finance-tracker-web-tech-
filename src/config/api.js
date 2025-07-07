// API Configuration - Use environment variables
const API_CONFIG = {
  baseURL: process.env.VUE_APP_API_BASE_URL || 'http://localhost/finance-tracker/finance-backend/api/transactions',
  timeout: 15000,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
};

// Environment-specific settings
if (process.env.VUE_APP_ENVIRONMENT === 'production') {
  // Production optimizations
  API_CONFIG.timeout = 10000;
  API_CONFIG.headers['X-Requested-With'] = 'XMLHttpRequest';
}

// Debug logging in development
if (process.env.VUE_APP_DEBUG === 'true' || process.env.NODE_ENV === 'development') {
  console.log('API Configuration:', API_CONFIG);
}

export default API_CONFIG;
