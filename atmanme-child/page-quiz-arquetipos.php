<?php
/**
* Template Name: Archetype Quiz
*
* @package Inspiro
* @subpackage Inspiro_Lite
*/

get_header(); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">

<!-- HERO SECTION -->
<section id="quiz-hero" class="atmanme-section-header" style="text-align: center; padding: 4rem 1rem;">
<h1 class="page-title" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary);">What Is Your Astrological Archetype?</h1>
<p style="font-family: var(--atmanme-font-body); color: var(--atmanme-color-text); max-width: 600px; margin: 1rem auto 2rem;">Discover the dominant energy within you and learn how to use it for your personal growth.</p>
<button id="start-quiz-btn" class="atmanme-btn" style="padding: 1rem 2rem; font-size: 1.1rem; border: none; cursor: pointer; border-radius: 4px;">Start the free quiz</button>
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
<span class="atmanme-category-badge" style="display: inline-block; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; margin-bottom: 1rem;">Your Archetype</span>
<h2 id="archetype-title" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-accent); font-size: 2.5rem; margin-bottom: 1rem;"></h2>
<p id="archetype-desc" style="color: var(--atmanme-color-text); font-size: 1.1rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;"></p>

<div id="lead-form-container" style="background: var(--atmanme-color-bg); padding: 2rem; border-radius: 8px; margin-top: 2rem;">
<h3 style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1rem;">Unlock your full report</h3>
<p style="margin-bottom: 1.5rem; color: var(--atmanme-color-text);">Enter your email to receive an in-depth analysis of your archetype, strengths, and growth areas.</p>
<form id="quiz-lead-form" style="display: flex; flex-direction: column; gap: 1rem; max-width: 400px; margin: 0 auto;">
<input type="email" id="lead-email" required placeholder="Your best email" style="padding: 1rem; border: 1px solid #ccc; border-radius: 4px; font-family: var(--atmanme-font-body);">
<button type="submit" class="atmanme-btn" style="padding: 1rem; border: none; cursor: pointer; border-radius: 4px; font-size: 1.1rem;">Send my report</button>
</form>
<p id="form-message" style="margin-top: 1rem; font-weight: bold; display: none;"></p>
</div>

<div id="full-report-container" style="display: none; margin-top: 2rem; text-align: left; padding-top: 2rem; border-top: 1px solid #eee;">
<h3 style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1rem;">Full Report</h3>
<p>Thank you! Check your inbox in the next few minutes to read all about your archetype.</p>
</div>
</div>

<!-- UPSELL SECTION -->
<div style="margin-top: 4rem; padding-top: 3rem; border-top: 2px solid var(--atmanme-color-bg);">
<h3 class="atmanme-section-header" style="font-family: var(--atmanme-font-heading); color: var(--atmanme-color-primary); margin-bottom: 1rem;">Dive Deeper Into Your Birth Chart</h3>
<p style="margin-bottom: 2rem; color: var(--atmanme-color-text);">Knowing your archetype is just the beginning. Discover your full cosmic map.</p>
<a href="/birth-chart/" class="atmanme-btn" style="display: inline-block; padding: 1rem 2rem; text-decoration: none; border-radius: 4px;">Explore Birth Charts</a>
</div>
</section>

</main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
// 1. Data Structure
const archetypes = {
visionario: {
title: "The Visionary",
desc: "You have a deep connection with the future and innovative ideas. Your energy inspires others to think differently."
},
sanador: {
title: "The Healer",
desc: "You have natural empathy. Your presence brings calm and understanding to those around you."
},
guardian: {
title: "The Guardian",
desc: "You are the pillar of your community. You protect what is valuable and keep traditions alive."
},
creador: {
title: "The Creator",
desc: "You turn imagination into reality. You have an endless drive to bring new forms to life."
}
};

const questions = [
{
text: "Which element intuitively attracts you the most?",
options: [
{ text: "The fresh mountain air (Visionary)", score: "visionario" },
{ text: "The sound of a flowing river (Healer)", score: "sanador" },
{ text: "Firm ground beneath your feet (Guardian)", score: "guardian" },
{ text: "The warmth of a bonfire (Creator)", score: "creador" }
]
},
{
text: "In a group of friends, what role do you usually play?",
options: [
{ text: "The one who proposes wild, new plans", score: "visionario" },
{ text: "The one who listens and advises others", score: "sanador" },
{ text: "The one who organizes and makes sure everyone's okay", score: "guardian" },
{ text: "The one who livens up parties and sets the mood", score: "creador" }
]
},
{
text: "How do you face a difficult problem?",
options: [
{ text: "I look for completely new perspectives", score: "visionario" },
{ text: "I connect with my emotions before acting", score: "sanador" },
{ text: "I stick to what has worked in the past", score: "guardian" },
{ text: "I experiment with different creative solutions", score: "creador" }
]
},
{
text: "Which of these places do you prefer to recharge your energy?",
options: [
{ text: "An observatory or high viewpoint", score: "visionario" },
{ text: "A quiet forest or spiritual retreat", score: "sanador" },
{ text: "My home, in my safe space", score: "guardian" },
{ text: "A lively art studio or workshop", score: "creador" }
]
},
{
text: "Which phrase resonates most with you?",
options: [
{ text: "\"The future belongs to those who believe in the beauty of their dreams.\"", score: "visionario" },
{ text: "\"Compassion will cure more sins than condemnation.\"", score: "sanador" },
{ text: "\"Deep roots never doubt that spring will come.\"", score: "guardian" },
{ text: "\"Creativity is intelligence having fun.\"", score: "creador" }
]
},
{
text: "When you have free time, you prefer to...",
options: [
{ text: "Read about trends, science, or the universe", score: "visionario" },
{ text: "Meditate, do yoga, or take care of others", score: "sanador" },
{ text: "Tend the garden, organize the house, or cook", score: "guardian" },
{ text: "Paint, write, or start a DIY project", score: "creador" }
]
},
{
text: "Which quality do you value most in yourself?",
options: [
{ text: "My ability to imagine possibilities", score: "visionario" },
{ text: "My sensitivity and empathy", score: "sanador" },
{ text: "My loyalty and sense of responsibility", score: "guardian" },
{ text: "My originality and passion", score: "creador" }
]
},
{
text: "If you could change one thing about today's world, it would be...",
options: [
{ text: "The lack of long-term vision", score: "visionario" },
{ text: "Emotional disconnection", score: "sanador" },
{ text: "Instability and the loss of values", score: "guardian" },
{ text: "Monotony and lack of expression", score: "creador" }
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
gtag('event', 'quiz_start', { 'event_category': 'Engagement', 'event_label': 'Archetypes' });
} else if (typeof dataLayer !== 'undefined') {
dataLayer.push({'event': 'quiz_start', 'category': 'Engagement', 'label': 'Archetypes'});
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
gtag('event', 'quiz_complete', { 'event_category': 'Engagement', 'event_label': 'Archetypes', 'archetype': finalArchetype });
} else if (typeof dataLayer !== 'undefined') {
dataLayer.push({'event': 'quiz_complete', 'category': 'Engagement', 'label': 'Archetypes', 'archetype': finalArchetype});
}
}

// 4. Form Submission (AJAX)
leadForm.addEventListener('submit', function(e) {
e.preventDefault();

const email = document.getElementById('lead-email').value;
const submitBtn = leadForm.querySelector('button[type="submit"]');
submitBtn.disabled = true;
submitBtn.textContent = 'Sending...';

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
gtag('event', 'generate_lead', { 'event_category': 'Lead', 'event_label': 'Archetype Quiz' });
} else if (typeof dataLayer !== 'undefined') {
dataLayer.push({'event': 'generate_lead', 'category': 'Lead', 'label': 'Archetype Quiz'});
}
} else {
formMessage.style.display = 'block';
formMessage.style.color = 'red';
formMessage.textContent = data.data.message || 'There was an error. Please try again.';
submitBtn.disabled = false;
submitBtn.textContent = 'Send my report';
}
})
.catch(error => {
console.error('Error:', error);
formMessage.style.display = 'block';
formMessage.style.color = 'red';
formMessage.textContent = 'Connection error. Please try again.';
submitBtn.disabled = false;
submitBtn.textContent = 'Send my report';
});
});
});
</script>

<?php get_footer(); ?>
