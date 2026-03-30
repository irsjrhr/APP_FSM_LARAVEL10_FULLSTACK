var ENV = window.ENV;//DIAMBIL DARI .env laravel di passing ke variabel global window pada footer di index SPA template
console.group('DEBUG ENV');
console.log(ENV);
console.groupEnd('+++++++');

const BASE_URL_PAGE = ENV.BASE_URL_PAGE; 

// ++++++++++++ CONSTANT SPA ++++++++
var SPA_EVENT_NAMESPACE = ENV.SPA_EVENT_NAMESPACE;
var SPA_ROUTE_PREFIX_KEYWORD = ENV.SPA_ROUTE_PREFIX_KEYWORD;

// ++++++++++++ CONSTANT REQUEST API SERVICE ++++++++
// UNTUK URL APP BE TERKAIT SERVICE BE DENGAN CI
const URL_SERVICE_CI = ENV.URL_SERVICE_CI;
// UNTUK URL APP BE TERKAIT SERVICE BE DENGAN LARAVEL
const URL_SERVICE_BE = ENV.URL_SERVICE_BE;

// UNTUK URL APP BE TERKAIT SERVICE BE FILE
const URL_SERVICE_FILE = ENV.URL_SERVICE_FILE;

//Untuk menghandle debug fungsi trace di seluruh fungsi dengan trace ada di core.js
//Jadikan false jika ingin debug trace dimatikan dan dissarankkan untuk melakukn itu ketika masuk ke prod agar tidak memberatkan server prod
const DEBUG_CONSOLE_TRACE = true;