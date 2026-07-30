    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <a href="index.php" class="brand footer-brand">
                    <span class="brand-mark">WP</span>
                    <span>
                        <strong>Watches</strong>
                        <small>Prishtina</small>
                    </span>
                </a>
                <p>Ore premium, oferta te zgjedhura dhe porosi e thjeshte online.</p>
            </div>

            <div class="footer-links">
                <a href="orat.php">Katalogu</a>
                <a href="shporta.php">Shporta</a>
                <?php if(isAdmin()): ?>
                    <a href="brendet.php">Brendet</a>
                    <a href="ofertat.php">Ofertat</a>
                <?php endif; ?>
            </div>

            <div class="footer-socials" aria-label="Social media">
                <a href="#" aria-label="Facebook"><i class="mdi mdi-facebook"></i></a>
                <a href="#" aria-label="Instagram"><i class="mdi mdi-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="mdi mdi-youtube"></i></a>
            </div>
        </div>
        <div class="footer-bottom">Watches Prishtina &copy; <?= date('Y'); ?>. All rights reserved.</div>
    </footer>

    <script src="jquery-3.6.0.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script>
        $("#message").fadeOut(4500, function(){
            $.ajax({ url: "./inc/functions.php?argument=message" });
        });

        $("#logout").click(function(event){
            event.preventDefault();
            $.ajax({
                url: "./inc/functions.php?argument=logout",
                success: function(data) {
                    window.location.href = data;
                }
            });
        });
    </script>
</body>
</html>
