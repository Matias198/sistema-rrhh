import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

// Create an Axios instance
const axiosClient = axios.create({
    baseURL: '/api', // Base URL for your API endpoints
    timeout: 5000,   // Request timeout in milliseconds
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export default axiosClient