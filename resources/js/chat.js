import "./echo.js";

const chat_box = document.querySelector("#chat-section");
const message_container = document.querySelector("#chat-messages");
const chat_users = document.querySelectorAll(".chat-user");
const input_target_id = document.querySelector("#target_id");

const auth_id = document.querySelector('meta[name="user-id"]').content;

// Load messages from database
chat_users.forEach(user => {
    user.addEventListener("click", (e) => {
        e.preventDefault();

        // Load previous messages
        var target_id = user.dataset.id;
        const url = user.dataset.route;

        input_target_id.value = target_id;

        fetch(url)
            .then(response => response.json())
            .then(messages => {
                message_container.innerHTML = '';

                messages.forEach(message => {
                    var is_sender = message.user_sender_id == auth_id;

                    var div = document.createElement("div");
                    const format = {
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: false
                    };

                    if (is_sender)
                    {
                        div.className = `d-flex flex-row justify-content-start col-9`;

                        div.innerHTML = `
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">
                            <div>
                                <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">${message.message}</p>
                                <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${new Date(message.created_at).toLocaleTimeString("pt-BR", format)}</p>
                            </div>
                        `;
                    }
                    else
                    {
                        div.className = `d-flex flex-row justify-content-end`;

                        div.innerHTML = `
                            <div class="col-9">
                                <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">${message.message}</p>
                                <p class="small me-3 mb-3 rounded-3 text-muted">${new Date(message.created_at).toLocaleTimeString("pt-BR", format)}</p>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">
                        `;
                    }

                    message_container.appendChild(div);
                });

                chat_box.classList.remove("d-none");
            });
    });
});


// Sent message from form
document.getElementById("chat-form").addEventListener("submit", async function (e) {
    e.preventDefault();

    const form_data = new FormData(this);
    const url = this.getAttribute("action");
    const csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            body: form_data
        });

        const result = await response.json();

        // Adiciona a mensagem no chat
        const div = document.createElement("div");
        const format = {
            hour: "2-digit",
            minute: "2-digit",
            hour12: false
        };

        div.className = `d-flex flex-row justify-content-start col-9`;

        div.innerHTML = `
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">
            <div>
                <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">${result.message}</p>
                <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${new Date(result.created_at).toLocaleTimeString("pt-BR", format)}</p>
            </div>
        `;

        message_container.appendChild(div);
        message_container.scrollTop = message_container.scrollHeight;
        this.reset();


        // Update last_message_send on list from users that we can contact
        const user = Array.from(chat_users).find(u => u.dataset.id == result.user_receiver_id);

        if (user)
        {
            const last_message = document.querySelector("#last_message");
            const last_message_time = document.querySelector("#last_message_time");

            last_message.textContent = result.message;
            last_message_time.textContent = "Agora";
        }
    }
    catch (error)
    {
        console.log("Erro ao enviar a mensagem:", error);
    }
});

if (auth_id)
{
    window.Echo.private(`messages.${auth_id}`)
        .listen(".MessageSent", (e) => {

            // Update last_message_send on list from users that we can contact
            const user = Array.from(chat_users).find(u => u.dataset.id == e.user_sender_id);

            if (user)
            {
                const last_message = document.querySelector("#last_message");
                const last_message_time = document.querySelector("#last_message_time");

                last_message.textContent = e.message;
                last_message_time.textContent = "Agora";
            }

            //  Append new message on the chat if opened
            const target_id = Number(input_target_id.value);
            if (!chat_box.classList.contains("d-none") && target_id == e.user_sender_id)
            {
                const format = {
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: false
                };
                const div = document.createElement('div');
                div.className = `d-flex flex-row justify-content-end`;

                div.innerHTML = `
                    <div class="col-9">
                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">${e.message}</p>
                        <p class="small me-3 mb-3 rounded-3 text-muted">${new Date(e.created_at).toLocaleTimeString("pt-BR", format)}</p>
                    </div>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">
                `;

                message_container.appendChild(div);
                message_container.scrollTop = message_container.scrollHeight;
            }

        })
        .error((error) => {
            console.error("Erro ao conectar ao canal privado:", error);
        });
}


