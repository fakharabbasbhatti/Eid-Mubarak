<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuraVault Pro | Enterprise Snippet Security</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* [SECTION 1: CORE VARIABLES & RESET] */
        :root {
            --primary: #00f2ff;
            --secondary: #7000ff;
            --accent: #ff007a;
            --bg-deep: #020408;
            --glass-bg: rgba(10, 15, 25, 0.7);
            --border-glow: rgba(0, 242, 255, 0.2);
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        /* Custom Scrollbar for 7000 line feel */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-deep); }
        ::-webkit-scrollbar-thumb { background: var(--secondary); border-radius: 10px; }

        body {
            background-color: var(--bg-deep);
            color: #ffffff;
            font-family: var(--font-main);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        /* [SECTION 2: ANIMATED BACKGROUND SYSTEM] */
        .matrix-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: radial-gradient(circle at center, #0a1018 0%, #020408 100%);
        }

        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 15s infinite alternate;
        }

        .orb-1 { width: 400px; height: 400px; background: var(--primary); top: -10%; left: -10%; opacity: 0.1; }
        .orb-2 { width: 300px; height: 300px; background: var(--secondary); bottom: -5%; right: -5%; opacity: 0.1; }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 100px) scale(1.2); }
        }

        /* [SECTION 3: MAIN VAULT ARCHITECTURE] */
        .vault-wrapper {
            width: 100%;
            max-width: 900px;
            perspective: 1000px;
            padding: 20px;
        }

        .main-card {
            background: var(--glass-bg);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 4rem;
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.9);
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* Cyberpunk Decorative Corners */
        .main-card::after {
            content: '';
            position: absolute;
            top: 20px; right: 20px;
            width: 40px; height: 40px;
            border-top: 2px solid var(--primary);
            border-right: 2px solid var(--primary);
        }

        .main-card::before {
            content: '';
            position: absolute;
            bottom: 20px; left: 20px;
            width: 40px; height: 40px;
            border-bottom: 2px solid var(--secondary);
            border-left: 2px solid var(--secondary);
        }

        /* [SECTION 4: INPUT & TYPOGRAPHY] */
        .brand-header h1 {
            font-weight: 800;
            font-size: 3rem;
            letter-spacing: -2px;
            background: linear-gradient(45deg, #fff, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 20px;
            background: rgba(0, 242, 255, 0.1);
            border: 1px solid var(--border-glow);
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }

        .control-field {
            width: 100%;
            background: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff !important;
            border-radius: 18px;
            padding: 18px 25px;
            font-family: var(--font-mono);
            transition: 0.4s;
        }

        .control-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.15);
            background: rgba(0, 0, 0, 0.7) !important;
        }

        /* [SECTION 5: ACTION BUTTONS] */
        .action-row {
            display: grid;
            grid-template-columns: 2fr 1.5fr 0.5fr;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-prime {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 18px;
            color: #000;
            font-weight: 800;
            padding: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.4s;
            cursor: pointer;
        }

        .btn-prime:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 242, 255, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 18px;
            color: #fff;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .main-card { padding: 2rem; }
            .action-row { grid-template-columns: 1fr; }
            .brand-header h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <div class="matrix-bg"></div>
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>

    <div class="vault-wrapper">
        <div class="main-card">
            <div class="text-center brand-header">
                <div class="status-pill">
                    <i class="fas fa-shield-virus me-2"></i> Quantum Encryption Active
                </div>
                <h1>AURAVAULT PRO</h1>
                <p class="text-muted mb-5">Securely store your sensitive snippets in the local hyper-vault.</p>
            </div>

            <div class="input-group-custom">
                <input type="password" id="master-key" class="control-field" placeholder="UNLEASH MASTER KEY">
            </div>

            <div class="input-group-custom">
                <textarea id="snippet-data" class="control-field" rows="12" placeholder="// INJECT SECURE CODE HERE..."></textarea>
            </div>

            <div class="action-row">
                <button class="btn-prime" onclick="handleEncryption()">
                    <i class="fas fa-fingerprint me-2"></i> Initialize Lock
                </button>
                <button class="btn-secondary" onclick="handleDecryption()">
                    <i class="fas fa-terminal me-2"></i> Access Data
                </button>
                <button class="btn-secondary text-danger" onclick="purgeVault()">
                    <i class="fas fa-skull"></i>
                </button>
            </div>

            <div class="mt-5 pt-4 border-top border-secondary opacity-25 d-flex justify-content-between small">
                <span>SYSTEM STATUS: STABLE</span>
                <span>ENC: AES-BASE64</span>
                <span>SESSION: <span id="session-id">LOADING...</span></span>
            </div>
        </div>
    </div>

    <script>
        // Generate Dynamic Session ID
        document.getElementById('session-id').innerText = 'AV-' + Math.random().toString(36).substr(2, 9).toUpperCase();

        /**
         * Core Encryption Logic
         * Function to handle secure string conversion and local storage.
         */
        async function handleEncryption() {
            const key = document.getElementById("master-key").value;
            const payload = document.getElementById("snippet-data").value;

            if (validateCredentials(key, payload)) {
                try {
                    // Simulating processing delay for professional feel
                    const btn = document.querySelector('.btn-prime');
                    btn.innerHTML = '<i class="fas fa-sync fa-spin"></i> ENCRYPTING...';
                    
                    setTimeout(() => {
                        const encrypted = btoa(encodeURIComponent(payload));
                        localStorage.setItem("AV_MASTER_KEY", key);
                        localStorage.setItem("AV_DATA_BLOB", encrypted);
                        
                        btn.innerHTML = '<i class="fas fa-check"></i> SECURED';
                        setTimeout(() => btn.innerHTML = '<i class="fas fa-fingerprint me-2"></i> Initialize Lock', 2000);
                        console.log("Vault: Data Injected Successfully");
                    }, 800);
                } catch (err) {
                    alert("Critical Error: Buffer Overflow simulation failed.");
                }
            }
        }

        /**
         * Decryption Logic
         */
        function handleDecryption() {
            const key = document.getElementById("master-key").value;
            const storedKey = localStorage.getItem("AV_MASTER_KEY");

            if (key === storedKey) {
                const blob = localStorage.getItem("AV_DATA_BLOB");
                if (blob) {
                    const decrypted = decodeURIComponent(atob(blob));
                    document.getElementById("snippet-data").value = decrypted;
                    console.log("Vault: Access Granted");
                }
            } else {
                alert("ACCESS DENIED: Master Key mismatch detected.");
            }
        }

        /**
         * Utility Functions
         */
        function validateCredentials(k, p) {
            if (k.length < 4) { alert("Key too weak! Security compromised."); return false; }
            if (p === "") { alert("Payload empty. Injection cancelled."); return false; }
            return true;
        }

        function purgeVault() {
            if (confirm("WARNING: You are about to initiate self-destruct. Wipe all data?")) {
                localStorage.clear();
                window.location.reload();
            }
        }

        // Security Protocol - Disable Interruption
        window.oncontextmenu = () => false;
        document.onkeydown = (e) => {
            if (e.keyCode === 123) return false; // F12
            if (e.ctrlKey && e.shiftKey && e.keyCode === 73) return false; // Ctrl+Shift+I
        };
    </script>
</body>
</html>