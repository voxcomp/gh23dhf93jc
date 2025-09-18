// bootstrap.js
window._ = require('lodash');
try {
    require('bootstrap'); // Bootstrap 5 JS (includes Popper)
} catch (e) {
    console.error(e);
}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';