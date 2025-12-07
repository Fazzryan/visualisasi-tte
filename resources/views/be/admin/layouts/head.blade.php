<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@stack('meta-seo')


<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

@stack('custom-css')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<script>
    // Alpine.js data function - akan otomatis terbaca oleh Alpine yang sudah di-import
    function dashboardData() {
        return {
            sidebarOpen: false,
            profileOpen: false,

            init() {
                console.log('Dashboard initialized');
            },

            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
            },

            closeSidebar() {
                this.sidebarOpen = false;
            },

            openSidebar() {
                this.sidebarOpen = true;
            }
        }
    }
</script>
