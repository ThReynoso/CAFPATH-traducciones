console.log('main.js loaded');

function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Compensar la altura del header
        const headerOffset = 100;
        const elementPosition = section.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}

function changeLanguage(lang) {
    // Ajustar la ruta según la ubicación actual de la página
    const currentPath = window.location.pathname;
    const translationsPath = currentPath.includes('/views/public/') ?
        '../../assets/js/translations.json' :
        'assets/js/translations.json';

    // Fetch translations from the JSON file with the correct path
    fetch(translationsPath)
        .then(response => response.json())
        .then(translations => {
            // Store the selected language in localStorage
            localStorage.setItem('preferredLanguage', lang);

            // Get all elements that need translation
            const elements = document.querySelectorAll('[data-translate]');

            // Update text content for each element
            elements.forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });

            // Update the HTML lang attribute
            document.documentElement.lang = lang;

            // You might want to reload certain parts of your page or fetch new data here
            // For example: updateContent(lang);
        })
        .catch(error => console.error('Error loading translations:', error));
}

// Function to set initial language
function setInitialLanguage() {
    const lang = localStorage.getItem('preferredLanguage') || 'en';
    changeLanguage(lang);
}

// Call setInitialLanguage when the page loads
document.addEventListener('DOMContentLoaded', () => {
    console.log('main.js loaded');
    setInitialLanguage();
    initializeFAQ();
});

// Modify the FAQ functionality
function initializeFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        }
    });
}

function showService(service) {
    // Desactivar todos los botones y contenido
    const buttons = document.querySelectorAll('.service-btn');
    buttons.forEach(button => button.classList.remove('active'));

    const contents = document.querySelectorAll('.service-content');
    contents.forEach(content => {
        content.classList.remove('active');
        content.style.opacity = 0;
    });

    // Activar el botón y contenido seleccionados
    document.querySelector(`.service-btn[onclick="showService('${service}')"]`).classList.add('active');
    const activeContent = document.getElementById(service);
    activeContent.classList.add('active');
    setTimeout(() => {
        activeContent.style.opacity = 1;
    }, 10);
}

function toggleService(service) {
    // Obtener el botón y el contenido correspondientes
    const button = document.querySelector(`.service-btn[onclick="toggleService('${service}')"]`);
    const content = document.getElementById(service);

    // Verificar si el contenido ya está visible
    const isActive = content.classList.contains('active');

    // Ocultar todos los contenidos y desactivar todos los botones
    const buttons = document.querySelectorAll('.service-btn');
    buttons.forEach(btn => btn.classList.remove('active'));

    const contents = document.querySelectorAll('.service-content');
    contents.forEach(cont => {
        cont.classList.remove('active');
        cont.style.opacity = 0;
    });

    // Si no estaba activo, mostrar el contenido y activar el botón
    if (!isActive) {
        button.classList.add('active');
        content.classList.add('active');
        setTimeout(() => {
            content.style.opacity = 1;
        }, 10);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const chatWidget = document.getElementById('chat-widget');
    const toggleButton = document.getElementById('toggle-chat');
    const chatMessages = document.getElementById('chat-messages');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-message');

    let answers = {};

    // Load predefined answers from JSON
    fetch('../../assets/js/responses.json')
        .then(response => response.json())
        .then(data => {
            answers = data;
        })
        .catch(error => console.error('Error loading answers:', error));

    // Toggle chat visibility
    const chatHeader = chatWidget.querySelector('.chat-header');
    chatHeader.addEventListener('click', function() {
        chatWidget.classList.toggle('minimized');
    });

    // Function to add a new message
    function addMessage(message, isUser = false) {
        const now = new Date();
        const time = now.getHours().toString().padStart(2, '0') + ':' +
            now.getMinutes().toString().padStart(2, '0');

        const messageHTML = `
            <div class="message ${isUser ? 'user' : 'support'}">
                <div class="message-content">
                    <p>${message}</p>
                    <span class="message-time">${time}</span>
                </div>
            </div>
        `;

        chatMessages.insertAdjacentHTML('beforeend', messageHTML);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Send message function
    function sendMessage() {
        const message = chatInput.value.trim();
        if (message) {
            addMessage(message, true);
            chatInput.value = '';

            // Check for predefined answers
            const response = getResponse(message.toLowerCase());
            if (response) {
                addMessage(response);
            } else {
                addMessage("I'm sorry, I didn't understand that. Can you please rephrase? If you need asistance try asking 'help'.");
            }
        }
    }

    // Function to get a response based on user input
    function getResponse(userInput) {
        for (const key in answers) {
            if (userInput.includes(key)) {
                return answers[key];
            }
        }
        return null;
    }

    // Send button click handler
    sendButton.addEventListener('click', sendMessage);

    // Enter key handler
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
});