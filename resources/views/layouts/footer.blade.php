
<!-- FontAwesome para os ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

 <!-- Footer -->
 <footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-md-3 col-12 text-center text-md-left mb-3 mb-md-0">
                <div class="logo-footer">
                    <img src="/assets/univicosa_horizontal.LOGO.png" alt="Logo">
                </div>
            </div>
            <!-- Contato -->
            <div class="col-md-3 col-12 text-center text-md-left mb-3 mb-md-0">
                <h5>Contato</h5>
                <p>Telefone: (31) 3899-8000</p>
                <p>Email: contato@univicosa.com</p>
            </div>
            <!-- Institucional -->
            <div class="col-md-3 col-12 text-center text-md-left mb-3 mb-md-0">
                <h5>Institucional</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Resultados</a></li>
                    <li><a href="#">Avaliar Trabalhos</a></li>
                    <li><a href="#">Preferências</a></li>
                </ul>
            </div>
            <!-- Redes Sociais -->
            <div class="col-md-3 col-12 text-center text-md-left">
                <div class="social-icons">
                    <a href="https://facebook.com" target="_blank" class="fab fa-facebook-f"></a>
                    <a href="https://twitter.com" target="_blank" class="fab fa-twitter"></a>
                    <a href="https://instagram.com" target="_blank" class="fab fa-instagram"></a>
                    <a href="https://linkedin.com" target="_blank" class="fab fa-linkedin-in"></a>
                </div>
            </div>
        </div>
        <div class="dev">
            <p><strong>Desenvolvido por Luiz Miguel e Vinicius Fontes</strong></p>
        </div>
    </div>
</footer>

<style>
    /* Estilo geral */
    html, body {
        height: 100%;
        margin: 0;
    }
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .content {
        flex: 1;
    }
    .footer {
        background-color: #000000;
        padding: 20px 0;
        color: #ffffff;
        text-align: center;
    }
    .footer .logo-footer img {
        max-height: 60px;
    }
    .footer .social-icons a {
        color: #ffffff; /* Cor dos ícones das redes sociais */
        margin: 0 10px;
        font-size: 24px;
    }
    .footer h5 {
        font-weight: bold; /* Negrito para os títulos */
    }
    .footer a {
        color: #ffffff; /* Cor dos links */
        text-decoration: none; /* Remove o sublinhado dos links */
    }
    .footer a:hover {
        text-decoration: underline; /* Sublinha os links ao passar o mouse */
    }
    .dev {
        color: rgb(102, 75, 9);
    }
</style>