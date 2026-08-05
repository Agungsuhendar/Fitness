<button onclick="scrollToTop()" 
        id="backToTopBtn" 
        class="back-to-top-btn" 
        aria-label="Kembali ke atas"
        title="Kembali ke atas">
    <i class="fa-solid fa-chevron-up"></i>
</button>

<style>
.back-to-top-btn {
    position: fixed;
    bottom: 90px;
    right: 24px;
    width: 54px;
    height: 54px;
    background: #0d1310;
    color: #84cc16;
    border: 2px solid #84cc16;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5), 0 0 15px rgba(132, 204, 22, 0.2);
    cursor: pointer;
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

.back-to-top-btn.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top-btn:hover {
    background: #84cc16;
    color: #090d0b;
    transform: translateY(-4px) scale(1.08);
    box-shadow: 0 15px 30px rgba(132, 204, 22, 0.5);
}

@media (max-width: 640px) {
    .back-to-top-btn {
        bottom: 136px;
        right: 18px;
        width: 48px;
        height: 48px;
        font-size: 1.05rem;
    }
}
</style>

<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.addEventListener('scroll', function() {
        const btn = document.getElementById('backToTopBtn');
        if (btn) {
            if (window.scrollY > 300) {
                btn.classList.add('show');
            } else {
                btn.classList.remove('show');
            }
        }
    });
</script>
