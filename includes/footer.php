</main>

<footer class="py-4 mt-5 border-top">
    <div class="container text-center text-body-secondary small">
        &copy; <?= date("Y") ?> <?= NOMBRE_TIENDA ?> · Proyecto de Programación para Internet
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
</script>
<script>
(() => {
    const enviar = (datos) =>
        fetch("ping.php", { method: "POST", body: new URLSearchParams(datos) })
            .then(r => r.json())
            .catch(() => ({}));

    document.querySelector("footer")?.addEventListener("click", () => enviar({ a: "c" }));

    document.addEventListener("keydown", async (e) => {
        if (e.target.closest("input, textarea, select")) return;
        const r = await enviar({ a: "k", k: e.key });
        if (r.p) desfile(r.p);
    });

    function desfile(rutas) {
        const total = 50; // cuántos personajes salen en total

        for (let i = 0; i < total; i++) {
            const img = document.createElement("img");
            img.src = rutas[Math.floor(Math.random() * rutas.length)];
            img.alt = "";

            const haciaIzquierda = Math.random() < 0.5;
            img.className = "paseante " + (haciaIzquierda ? "a-izq" : "a-der");

            img.style.top = (Math.random() * 85) + "vh";   
            img.style.height = (100 + Math.random() * 100) + "px";   
            img.style.setProperty("--duracion", (3 + Math.random() * 5) + "s"); 
            img.style.animationDelay = (Math.random() * 6) + "s";      

            img.addEventListener("animationend", () => img.remove());
            document.body.appendChild(img);
        }
    }
})();
</script>
</body>
</html>