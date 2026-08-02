<button onclick="scrollToTop()" 
        id="backToTopBtn" 
        class="back-to-top-btn" 
        aria-label="Kembali ke atas"
        title="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<style>
.back-to-top-btn {
    position: fixed;
    bottom: 94px;
    right: 30px;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
    color: #ffffff;
    border: 2px solid rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    box-shadow: 0 10px 25px rgba(0, 119, 182, 0.35);
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
    background: linear-gradient(135deg, #03045e 0%, #0077b6 100%);
    transform: translateY(-4px) scale(1.08);
    box-shadow: 0 16px 32px rgba(0, 119, 182, 0.5);
}

@media (max-width: 640px) {
    .back-to-top-btn {
        bottom: 84px;
        right: 25px;
        width: 44px;
        height: 44px;
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
            if (window.scrollY > 280) {
                btn.classList.add('show');
            } else {
                btn.classList.remove('show');
            }
        }
    });
</script>
