<?php
/**
 * Template Name: Quiz de Arquetipos
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <!-- HERO SECTION -->
        <section id="quiz-hero" class="atmanme-section-header" style="text-align: center; padding: 4rem 1rem;">
            <h1 class="page-title" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary);">¿Cuál es tu arquetipo astrológico?</h1>
            <p style="font-family: var(--atmanme-font-body); color: var(--atmanme-color-text); max-width: 600px; margin: 1rem auto 2rem;">Descubre la energía dominante en tu interior y aprende a usarla para tu evolución personal.</p>
            <button id="start-quiz-btn" class="atmanme-btn" style="padding: 1rem 2rem; font-size: 1.1rem; border: none; cursor: pointer; border-radius: 4px;">Comenzar el quiz gratis</button>
        </section>

        <!-- QUIZ CONTAINER -->
        <section id="quiz-container" style="display: none; max-width: 800px; margin: 0 auto; padding: 2rem 1rem; font-family: var(--atmanme-font-body);">

            <div id="progress-container" style="width: 100%; background-color: #ddd; height: 10px; margin-bottom: 2rem; border-radius: 5px; overflow: hidden;">
                <div id="progress-bar" style="width: 0%; height: 100%; background-color: var(--atmanme-color-accent); transition: width 0.3s ease;"></div>
            </div>

            <div id="question-container" style="background: var(--atmanme-color-white); padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h2 id="question-text" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1.5rem; text-align: center;"></h2>
                <div id="options-container" style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Options will be injected here -->
                </div>
            </div>
        </section>

        <!-- PARTIAL RESULT & LEAD CAPTURE -->
        <section id="result-container" style="display: none; max-width: 800px; margin: 0 auto; padding: 2rem 1rem; text-align: center; font-family: var(--atmanme-font-body);">
            <div style="background: var(--atmanme-color-white); padding: 3rem 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <span class="atmanme-category-badge" style="display: inline-block; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; margin-bottom: 1rem;">Tu Arquetipo</span>
                <h2 id="archetype-title" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-accent); font-size: 2.5rem; margin-bottom: 1rem;"></h2>
                <p id="archetype-desc" style="color: var(--atmanme-color-text); font-size: 1.1rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;"></p>

                <div id="lead-form-container" style="background: var(--atmanme-color-bg); padding: 2rem; border-radius: 8px; margin-top: 2rem;">
                    <h3 style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1rem;">Desbloquea tu informe completo</h3>
                    <p style="margin-bottom: 1.5rem; color: var(--atmanme-color-text);">Ingresa tu email para recibir un análisis profundo de tu arquetipo, fortalezas y áreas de crecimiento.</p>
                    <form id="quiz-lead-form" style="display: flex; flex-direction: column; gap: 1rem; max-width: 400px; margin: 0 auto;">
                        <input type="email" id="lead-email" required placeholder="Tu mejor email" style="padding: 1rem; border: 1px solid #ccc; border-radius: 4px; font-family: var(--atmanme-font-body);">
                        <button type="submit" class="atmanme-btn" style="padding: 1rem; border: none; cursor: pointer; border-radius: 4px; font-size: 1.1rem;">Enviar mi informe</button>
                    </form>
                    <p id="form-message" style="margin-top: 1rem; font-weight: bold; display: none;"></p>
                </div>

                <div id="full-report-container" style="display: none; margin-top: 2rem; text-align: left; padding-top: 2rem; border-top: 1px solid #eee;">
                     <h3 style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1rem;">Informe Completo</h3>
                     <p>¡Gracias! Revisa tu bandeja de entrada en los próximos minutos para leer todo sobre tu arquetipo.</p>
                </div>
            </div>

            <!-- UPSELL SECTION -->
            <div style="margin-top: 4rem; padding-top: 3rem; border-top: 2px solid var(--atmanme-color-bg);">
                <h3 class="atmanme-section-header" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1rem;">Profundiza en tu Carta Astral</h3>
                <p style="margin-bottom: 2rem; color: var(--atmanme-color-text);">Conocer tu arquetipo es solo el principio. Descubre tu mapa cósmico completo.</p>
                <a href="/cartas-astrales/" class="atmanme-btn" style="display: inline-block; padding: 1rem 2rem; text-decoration: none; border-radius: 4px;">Explorar Cartas Astrales</a>
            </div>
        </section>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Data Structure
    const archetypes = {
        visionario: {
            title: "El Visionario",
            desc: "Tienes una conexión profunda con el futuro y las ideas innovadoras. Tu energía inspira a otros a pensar diferente."
        },
        sanador: {
            title: "El Sanador",
            desc: "Posees una empatía natural. Tu presencia brinda calma y comprensión a quienes te rodean."
        },
        guardian: {
            title: "El Guardián",
            desc: "Eres el pilar de tu comunidad. Proteges lo que es valioso y mantienes las tradiciones vivas."
        },
        creador: {
            title: "El Creador",
            desc: "Transformas la imaginación en realidad. Tienes un impulso inagotable por dar vida a nuevas formas."
        }
    };

    const questions = [
        {
            text: "¿Qué elemento te atrae más intuitivamente?",
            options: [
                { text: "El aire fresco de la montaña (Visionario)", score: "visionario" },
                { text: "El sonido de un río fluyendo (Sanador)", score: "sanador" },
                { text: "La tierra firme bajo los pies (Guardián)", score: "guardian" },
                { text: "El calor de una fogata (Creador)", score: "creador" }
            ]
        },
        {
            text: "En un grupo de amigos, ¿cuál suele ser tu rol?",
            options: [
                { text: "Quien propone planes alocados y nuevos", score: "visionario" },
                { text: "Quien escucha y aconseja a los demás", score: "sanador" },
                { text: "Quien organiza y asegura que todos estén bien", score: "guardian" },
                { text: "Quien anima las fiestas y crea el ambiente", score: "creador" }
            ]
        },
        {
            text: "¿Cómo enfrentas un problema difícil?",
            options: [
                { text: "Busco perspectivas completamente nuevas", score: "visionario" },
                { text: "Me conecto con mis emociones antes de actuar", score: "sanador" },
                { text: "Me apego a lo que ha funcionado en el pasado", score: "guardian" },
                { text: "Experimento con diferentes soluciones creativas", score: "creador" }
            ]
        },
        {
            text: "¿Cuál de estos lugares prefieres para recargar energías?",
            options: [
                { text: "Un observatorio o mirador alto", score: "visionario" },
                { text: "Un bosque tranquilo o retiro espiritual", score: "sanador" },
                { text: "Mi hogar, en mi espacio seguro", score: "guardian" },
                { text: "Un estudio de arte o taller animado", score: "creador" }
            ]
        },
        {
            text: "¿Qué frase resuena más contigo?",
            options: [
                { text: "'El futuro pertenece a los que creen en la belleza de sus sueños.'", score: "visionario" },
                { text: "'La compasión curará más pecados que la condena.'", score: "sanador" },
                { text: "'Las raíces profundas nunca dudan que la primavera llegará.'", score: "guardian" },
                { text: "'La creatividad es la inteligencia divirtiéndose.'", score: "creador" }
            ]
        },
        {
            text: "Cuando tienes tiempo libre, prefieres...",
            options: [
                { text: "Leer sobre tendencias, ciencia o el universo", score: "visionario" },
                { text: "Meditar, hacer yoga o cuidar de otros", score: "sanador" },
                { text: "Cuidar el jardín, organizar la casa o cocinar", score: "guardian" },
                { text: "Pintar, escribir, o empezar un proyecto DIY", score: "creador" }
            ]
        },
        {
            text: "¿Qué cualidad valoras más en ti mismo/a?",
            options: [
                { text: "Mi capacidad de imaginar posibilidades", score: "visionario" },
                { text: "Mi sensibilidad y empatía", score: "sanador" },
                { text: "Mi lealtad y sentido de responsabilidad", score: "guardian" },
                { text: "Mi originalidad y pasión", score: "creador" }
            ]
        },
        {
            text: "Si pudieras cambiar algo del mundo de hoy, sería...",
            options: [
                { text: "La falta de visión a largo plazo", score: "visionario" },
                { text: "La desconexión emocional", score: "sanador" },
                { text: "La inestabilidad y pérdida de valores", score: "guardian" },
                { text: "La monotonía y falta de expresión", score: "creador" }
            ]
        }
    ];

    let currentQuestionIndex = 0;
    let scores = { visionario: 0, sanador: 0, guardian: 0, creador: 0 };
    let finalArchetype = '';

    // DOM Elements
    const heroSection = document.getElementById('quiz-hero');
    const startBtn = document.getElementById('start-quiz-btn');
    const quizContainer = document.getElementById('quiz-container');
    const questionText = document.getElementById('question-text');
    const optionsContainer = document.getElementById('options-container');
    const progressBar = document.getElementById('progress-bar');

    const resultContainer = document.getElementById('result-container');
    const archetypeTitle = document.getElementById('archetype-title');
    const archetypeDesc = document.getElementById('archetype-desc');
    const leadForm = document.getElementById('quiz-lead-form');
    const formMessage = document.getElementById('form-message');
    const leadFormContainer = document.getElementById('lead-form-container');
    const fullReportContainer = document.getElementById('full-report-container');

    // 2. Event Listeners
    startBtn.addEventListener('click', () => {
        // Track Start Event
        if (typeof gtag === 'function') {
            gtag('event', 'quiz_start', { 'event_category': 'Engagement', 'event_label': 'Arquetipos' });
        } else if (typeof dataLayer !== 'undefined') {
            dataLayer.push({'event': 'quiz_start', 'category': 'Engagement', 'label': 'Arquetipos'});
        }

        heroSection.style.display = 'none';
        quizContainer.style.display = 'block';
        renderQuestion();
    });

    // 3. Logic
    function renderQuestion() {
        if (currentQuestionIndex >= questions.length) {
            showResults();
            return;
        }

        const q = questions[currentQuestionIndex];
        questionText.textContent = q.text;
        optionsContainer.innerHTML = '';

        // Update Progress
        const progress = ((currentQuestionIndex) / questions.length) * 100;
        progressBar.style.width = progress + '%';

        q.options.forEach(opt => {
            const btn = document.createElement('button');
            btn.textContent = opt.text;
            btn.style.cssText = `
                padding: 1rem;
                background-color: var(--atmanme-color-white);
                border: 2px solid var(--atmanme-color-bg);
                border-radius: 4px;
                cursor: pointer;
                font-family: var(--atmanme-font-body);
                color: var(--atmanme-color-text);
                transition: all 0.2s ease;
                text-align: left;
                font-size: 1.05rem;
            `;

            btn.addEventListener('mouseover', () => {
                btn.style.borderColor = 'var(--atmanme-color-accent)';
            });
            btn.addEventListener('mouseout', () => {
                btn.style.borderColor = 'var(--atmanme-color-bg)';
            });

            btn.addEventListener('click', () => {
                scores[opt.score]++;
                currentQuestionIndex++;
                renderQuestion();
            });

            optionsContainer.appendChild(btn);
        });
    }

    function showResults() {
        quizContainer.style.display = 'none';
        resultContainer.style.display = 'block';

        progressBar.style.width = '100%';

        // Calculate Winner
        let maxScore = -1;
        for (const [key, value] of Object.entries(scores)) {
            if (value > maxScore) {
                maxScore = value;
                finalArchetype = key;
            }
        }

        archetypeTitle.textContent = archetypes[finalArchetype].title;
        archetypeDesc.textContent = archetypes[finalArchetype].desc;

        // Track Complete Event
        if (typeof gtag === 'function') {
            gtag('event', 'quiz_complete', { 'event_category': 'Engagement', 'event_label': 'Arquetipos', 'archetype': finalArchetype });
        } else if (typeof dataLayer !== 'undefined') {
            dataLayer.push({'event': 'quiz_complete', 'category': 'Engagement', 'label': 'Arquetipos', 'archetype': finalArchetype});
        }
    }

    // 4. Form Submission (AJAX)
    leadForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('lead-email').value;
        const submitBtn = leadForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Enviando...';

        const formData = new FormData();
        formData.append('action', 'atmanme_save_quiz_lead');
        formData.append('email', email);
        formData.append('archetype', finalArchetype);
        formData.append('quiz_nonce', '<?php echo wp_create_nonce("submit_quiz_lead"); ?>');

        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                leadFormContainer.style.display = 'none';
                fullReportContainer.style.display = 'block';

                // Track Lead Event
                if (typeof gtag === 'function') {
                    gtag('event', 'generate_lead', { 'event_category': 'Lead', 'event_label': 'Quiz Arquetipos' });
                } else if (typeof dataLayer !== 'undefined') {
                    dataLayer.push({'event': 'generate_lead', 'category': 'Lead', 'label': 'Quiz Arquetipos'});
                }
            } else {
                formMessage.style.display = 'block';
                formMessage.style.color = 'red';
                formMessage.textContent = data.data.message || 'Hubo un error. Intenta de nuevo.';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Enviar mi informe';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            formMessage.style.display = 'block';
            formMessage.style.color = 'red';
            formMessage.textContent = 'Error de conexión. Intenta de nuevo.';
            submitBtn.disabled = false;
            submitBtn.textContent = 'Enviar mi informe';
        });
    });
});
</script>

<?php get_footer(); ?>
