console.log("BOOTSTRAP FILE EXECUTED");

// Load full Bootstrap JS FIRST
import * as bootstrap from 'bootstrap';

// Expose all Bootstrap plugins globally
window.bootstrap = bootstrap;

// Axios setup
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
