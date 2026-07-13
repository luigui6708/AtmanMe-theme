<?php
/**
 * Template Name: Carta Astral Landing
 */

get_header(); ?>

<main id="main" class="site-main carta-astral-landing">
    <style>
        .carta-astral-landing { padding: 40px 20px; max-width: 1200px; margin: 0 auto; }
        .hero-section { display: flex; flex-wrap: wrap; gap: 40px; margin-bottom: 60px; align-items: center; }
        .hero-content { flex: 1; min-width: 300px; }
        .hero-image { flex: 1; min-width: 300px; text-align: center; }
        .hero-image img { max-width: 100%; border-radius: 8px; box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }

        .value-section { margin-bottom: 60px; }
        .value-cards { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .value-card { flex: 1; min-width: 250px; text-align: center; }

        .social-proof-section { background-color: var(--atmanme-color-white); padding: 40px; border-radius: 8px; margin-bottom: 60px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .testimonials { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-bottom: 20px; }
        .testimonial { flex: 1; min-width: 250px; text-align: center; }
        .testimonial img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; }
        .counter { text-align: center; font-size: 1.5rem; font-weight: bold; color: var(--atmanme-color-primary); }

        .comparison-section { margin-bottom: 60px; }
        .comparison-columns { display: flex; flex-wrap: wrap; gap: 20px; }
        .comparison-col { flex: 1; min-width: 300px; background-color: var(--atmanme-color-white); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .comparison-col.premium { border: 2px solid var(--atmanme-color-accent); }
        .comparison-col h3 { text-align: center; margin-top: 0; }
        .comparison-col ul { list-style: none; padding: 0; margin-bottom: 30px; }
        .comparison-col ul li { padding: 10px 0; border-bottom: 1px solid #eee; text-align: left; }
        .comparison-col ul li:last-child { border-bottom: none; }

        .faq-section { margin-bottom: 60px; }
        .faq-accordion details { background-color: var(--atmanme-color-white); margin-bottom: 10px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: left; }
        .faq-accordion summary { padding: 15px; font-weight: bold; cursor: pointer; color: var(--atmanme-color-primary); }
        .faq-accordion .faq-answer { padding: 0 15px 15px; margin: 0; color: var(--atmanme-color-text); }

        .final-cta-section { text-align: center; padding: 60px 20px; background-color: var(--atmanme-color-white); border-radius: 8px; }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="page-title">Descubre tu Carta Astral</h1>
            <p>Conoce la posición de los planetas en el momento de tu nacimiento y descubre tu verdadero potencial.</p>

            <?php if ( isset($_GET['success']) && $_GET['success'] == '1' ) : ?>
                <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                    ¡Datos guardados con éxito! Pronto recibirás tu carta astral.
                </div>
            <?php endif; ?>

            <form id="carta-astral-form" method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
                <?php wp_nonce_field('submit_carta_astral', 'carta_astral_nonce'); ?>
                <input type="hidden" name="action" value="submit_carta_astral_form">

                <div class="form-group">
                    <label for="ca_fecha">Fecha de nacimiento</label>
                    <input type="date" id="ca_fecha" name="ca_fecha" required>
                </div>
                <div class="form-group">
                    <label for="ca_hora">Hora de nacimiento</label>
                    <input type="time" id="ca_hora" name="ca_hora" required>
                </div>
                <div class="form-group">
                    <label for="ca_lugar">Lugar de nacimiento</label>
                    <input type="text" id="ca_lugar" name="ca_lugar" placeholder="Ciudad, País" required>
                </div>

                <button type="submit" class="atmanme-btn" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'generate_chart_hero_click'});">Generar mi carta astral</button>
            </form>
        </div>
        <div class="hero-image">
            <!-- REEMPLAZAR: Placeholder para la imagen de la carta natal, sustituir con imagen real desde media library -->
            <img src="https://via.placeholder.com/500x500.png?text=Carta+Astral+Muestra" alt="Muestra de Carta Astral">
        </div>
    </section>

    <!-- Value Section -->
    <section class="value-section">
        <h2 class="atmanme-section-header">¿Qué descubrirás?</h2>
        <div class="value-cards">
            <div class="atmanme-blog-card value-card">
                <div style="font-size: 2rem; margin-bottom: 10px;">🌟</div>
                <h3 class="entry-title">Personalidad</h3>
                <p class="entry-summary">Conoce tus fortalezas y debilidades profundas.</p>
            </div>
            <div class="atmanme-blog-card value-card">
                <div style="font-size: 2rem; margin-bottom: 10px;">⏳</div>
                <h3 class="entry-title">Ciclos de Vida</h3>
                <p class="entry-summary">Entiende tus ritmos y momentos clave.</p>
            </div>
            <div class="atmanme-blog-card value-card">
                <div style="font-size: 2rem; margin-bottom: 10px;">🎯</div>
                <h3 class="entry-title">Propósito</h3>
                <p class="entry-summary">Alinea tu vida con tu verdadera misión.</p>
            </div>
        </div>
    </section>

    <!-- Social Proof Section -->
    <section class="social-proof-section">
        <h2 class="atmanme-section-header">Lo que dicen nuestros usuarios</h2>
        <div class="testimonials">
            <div class="testimonial">
                <!-- REEMPLAZAR: Placeholder para foto de testimonio, sustituir con testimonios reales -->
                <img src="https://via.placeholder.com/80.png?text=M" alt="Foto de usuario María L.">
                <h4>María L.</h4>
                <p>"La carta astral me ayudó a entender cosas de mí que no sabía explicar. ¡Muy recomendada!"</p>
            </div>
            <div class="testimonial">
                <!-- REEMPLAZAR: Placeholder para foto de testimonio, sustituir con testimonios reales -->
                <img src="https://via.placeholder.com/80.png?text=C" alt="Foto de usuario Carlos G.">
                <h4>Carlos G.</h4>
                <p>"Excelente análisis. El informe premium vale cada centavo por la claridad que aporta."</p>
            </div>
        </div>
        <!-- En el futuro, conectar a datos reales de base de datos -->
        <div class="counter">
            +5,000 cartas generadas
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="comparison-section">
        <h2 class="atmanme-section-header">Elige tu experiencia</h2>
        <div class="comparison-columns">
            <div class="comparison-col">
                <h3>Carta Básica Gratis</h3>
                <ul>
                    <li>✅ Posición de planetas</li>
                    <li>✅ Signo solar, lunar y ascendente</li>
                    <li>❌ Interpretación profunda</li>
                    <li>❌ Formato PDF de marca</li>
                    <li>❌ Audio/Video explicativo</li>
                </ul>
                <div style="text-align: center;">
                    <a href="#carta-astral-form" class="atmanme-btn" style="background-color: #ccc !important; color: #333 !important;" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'select_free_chart'});">Obtener Gratis</a>
                </div>
            </div>
            <div class="comparison-col premium">
                <h3>Carta Premium</h3>
                <ul>
                    <li>✅ Posición de planetas</li>
                    <li>✅ Signo solar, lunar y ascendente</li>
                    <li>✅ Interpretación profunda personalizada</li>
                    <li>✅ Formato PDF de marca</li>
                    <li>✅ Audio/Video explicativo</li>
                </ul>
                <div style="text-align: center;">
                    <a href="#carta-astral-form" class="atmanme-btn" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'select_premium_chart'});">Comprar Premium</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <h2 class="atmanme-section-header">Preguntas Frecuentes</h2>
        <div class="faq-accordion">
            <details>
                <summary class="faq-question">¿Necesito saber mi hora exacta de nacimiento?</summary>
                <p class="faq-answer">Sí, la hora exacta es fundamental para calcular tu ascendente y las casas astrológicas con precisión.</p>
            </details>
            <details>
                <summary class="faq-question">¿Qué pasa si no sé mi hora de nacimiento?</summary>
                <p class="faq-answer">Puedes solicitar una carta solar o intentar obtener tu partida de nacimiento donde suele estar registrada.</p>
            </details>
            <details>
                <summary class="faq-question">¿Cuánto tarda en llegar la Carta Premium?</summary>
                <p class="faq-answer">La carta premium se genera de forma personalizada y la recibirás en tu correo electrónico en un plazo de 24 a 48 horas.</p>
            </details>
            <details>
                <summary class="faq-question">¿En qué formato entregan la Carta Premium?</summary>
                <p class="faq-answer">Recibirás un documento PDF con diseño exclusivo y un archivo de audio/video con la explicación detallada.</p>
            </details>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="final-cta-section">
        <h2>¿Listo para descubrir tu mapa estelar?</h2>
        <p style="margin-bottom: 30px;">Comienza tu viaje de autodescubrimiento hoy mismo.</p>
        <a href="#carta-astral-form" class="atmanme-btn" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'final_cta_click'});">Generar mi carta astral</a>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('carta-astral-form');
    if(form) {
        form.addEventListener('submit', function(e) {
            var fecha = document.getElementById('ca_fecha').value;
            var hora = document.getElementById('ca_hora').value;
            var lugar = document.getElementById('ca_lugar').value;

            if(!fecha || !hora || !lugar) {
                e.preventDefault();
                alert('Por favor, completa todos los campos.');
            }
        });
    }
});
</script>

<?php get_footer(); ?>
