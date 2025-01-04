<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');
    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .content {
        flex: 1;
    }

    .site-footer {
        position: static;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 10px 20px;
        text-align: center;
    }
</style>
</head>
<body>
    <div class="content">
        <!-- Your main content here -->
    </div>
    <footer class="site-footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> Tech Dome Penang. All rights reserved.</p>
        </div>
    </footer>
</body>