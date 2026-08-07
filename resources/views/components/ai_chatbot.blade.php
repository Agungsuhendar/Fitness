<!-- FitBot AI Chatbot Modal Window (Opens above Floating Action Stack) -->
<div id="aiChatbotModal" style="display: none; position: fixed; bottom: 90px; right: 24px; z-index: 100000; width: 380px; height: 510px; max-width: calc(100vw - 32px); background: #0d1310; border: 2px solid #a855f7; border-radius: 1.5rem; box-shadow: 0 25px 60px rgba(0,0,0,0.95), 0 0 35px rgba(168, 85, 247, 0.3); flex-direction: column; overflow: hidden; animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
    
    <!-- Modal Header -->
    <div style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); padding: 1rem 1.25rem; color: white; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
        <div style="display: flex; align-items: center; gap: 0.65rem;">
            <div style="width: 38px; height: 38px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 0 10px rgba(255,255,255,0.3);">
                🤖
            </div>
            <div>
                <h5 style="margin: 0; font-size: 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; color: #ffffff;">FitBot AI CS 24/7</h5>
                <span style="font-size: 0.725rem; color: #f0fdf4; display: flex; align-items: center; gap: 0.35rem;">
                    <span style="width: 7px; height: 7px; background: #84cc16; border-radius: 50%; display: inline-block; box-shadow: 0 0 6px #84cc16;"></span> Respon Otomatis Aktif
                </span>
            </div>
        </div>
        <button type="button" onclick="toggleAiChatbotModal()" style="background: rgba(255,255,255,0.15); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Tutup Chatbot">&times;</button>
    </div>

        <!-- Chat History Body -->
        <div id="chatMessages" style="flex: 1; padding: 1rem; overflow-y: auto; display: flex; flex-direction: column; gap: 0.85rem; background: #060907;">
            
            <!-- Default Welcome Bot Message -->
            <div style="display: flex; gap: 0.5rem; align-items: flex-start;">
                <div style="background: #0d1310; border: 1px solid #84cc16; color: white; padding: 0.85rem; border-radius: 1rem border-top-left-radius: 0.2rem; max-width: 85%; font-size: 0.825rem; line-height: 1.45;">
                    🤖 Halo! Saya <strong>FitBot AI</strong>, asisten virtual FitLife Center Jogja.<br><br>
                    Ada yang bisa saya bantu? Ketik misal: <em>"Berapa harga paket?"</em>, <em>"Lokasi dimana?"</em>, atau <em>"Program trainer privat"</em>.
                </div>
            </div>

        </div>

        <!-- Input Form Footer -->
        <form onsubmit="handleSendAiMessage(event)" style="padding: 0.75rem; background: #0d1310; border-top: 1px solid rgba(255,255,255,0.08); display: flex; gap: 0.5rem;">
            <input type="text" id="aiChatInput" placeholder="Ketik pertanyaan Anda..." required style="flex: 1; background: #060907; border: 1px solid rgba(255,255,255,0.15); border-radius: 99px; padding: 0.6rem 1rem; color: white; font-size: 0.825rem; outline: none; font-weight: 600;">
            <button type="submit" id="aiSendBtn" style="background: #84cc16; color: #090d0b; border: none; width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; cursor: pointer; font-weight: 900;">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

    </div>

<script>
    function toggleAiChatbotModal() {
        const modal = document.getElementById('aiChatbotModal');
        if (modal) {
            modal.style.display = (modal.style.display === 'none' || modal.style.display === '') ? 'flex' : 'none';
        }
    }

    function handleSendAiMessage(e) {
        e.preventDefault();
        const input = document.getElementById('aiChatInput');
        const container = document.getElementById('chatMessages');
        const text = input.value.trim();
        if (!text) return;

        // Render User Message Bubble
        const userBubble = document.createElement('div');
        userBubble.style.cssText = "display: flex; justify-content: flex-end;";
        userBubble.innerHTML = `<div style="background: #84cc16; color: #090d0b; padding: 0.75rem 0.95rem; border-radius: 1rem; border-top-right-radius: 0.2rem; max-width: 80%; font-size: 0.825rem; font-weight: 800;">${escapeHtml(text)}</div>`;
        container.appendChild(userBubble);

        input.value = '';
        container.scrollTop = container.scrollHeight;

        // Render Typing Indicator
        const typingBubble = document.createElement('div');
        typingBubble.id = 'typingIndicator';
        typingBubble.style.cssText = "display: flex; gap: 0.5rem; align-items: flex-start;";
        typingBubble.innerHTML = `<div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); color: #94a3b8; padding: 0.65rem 0.85rem; border-radius: 1rem; font-size: 0.8rem;"><i class="fa-solid fa-spinner fa-spin"></i> FitBot sedang mengetik...</div>`;
        container.appendChild(typingBubble);
        container.scrollTop = container.scrollHeight;

        fetch("{{ route('ai-chatbot.ask') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ message: text })
        })
        .then(res => res.json())
        .then(res => {
            const typ = document.getElementById('typingIndicator');
            if (typ) typ.remove();

            if (res.success) {
                const botBubble = document.createElement('div');
                botBubble.style.cssText = "display: flex; gap: 0.5rem; align-items: flex-start;";
                
                let btnHtml = '';
                if (res.action_button) {
                    btnHtml = `<a href="${res.action_button.url}" target="_blank" style="display: inline-block; margin-top: 0.65rem; background: rgba(132,204,22,0.2); border: 1px solid #84cc16; color: #84cc16; padding: 0.4rem 0.85rem; border-radius: 99px; font-weight: 800; font-size: 0.775rem; text-decoration: none;">${res.action_button.label}</a>`;
                }

                botBubble.innerHTML = `<div style="background: #0d1310; border: 1px solid #84cc16; color: white; padding: 0.85rem; border-radius: 1rem; border-top-left-radius: 0.2rem; max-width: 85%; font-size: 0.825rem; line-height: 1.45;">${formatMarkdownText(res.reply)} ${btnHtml}</div>`;
                container.appendChild(botBubble);
                container.scrollTop = container.scrollHeight;
            }
        })
        .catch(err => {
            const typ = document.getElementById('typingIndicator');
            if (typ) typ.remove();
        });
    }

    function escapeHtml(str) {
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
    }

    function formatMarkdownText(str) {
        return escapeHtml(str).replace(/\n/g, '<br>').replace(/\*(.*?)\*/g, '<strong>$1</strong>');
    }
</script>
