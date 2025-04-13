<br> <br>
<footer class="footer mt-auto py-3 bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Cinephoria Administration</h5>
                <p class="mb-0">© <?php echo date('Y'); ?> Tous droits réservés</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">
                    Connecté en tant que : <?php echo isset($_SESSION['admin_email']) ? htmlspecialchars($_SESSION['admin_email']) : 'Non connecté'; ?>
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #343a40;
        padding: 1rem 0;
    }
    body {
        padding-bottom: 60px; /* Pour éviter que le contenu ne soit caché par le footer */
    }
</style> 