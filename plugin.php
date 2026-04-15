<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberVault | Secure Snippets</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Fira+Code&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --accent: #00ffa3;
            --accent-dim: rgba(0, 255, 163, 0.15);
            --bg: #0b0e14;
            --card-bg: rgba(23, 28, 41, 0.8);
        }

        body {
            background: var(--bg);
            background-image: 
                radial-gradient(at 0% 0%, rgba(0, 255, 163, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 163, 255, 0.05) 0px, transparent 50%);
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow-x: hidden;
        }

        /* Glassmorphism Card with Animated Border */
        .vault-container {
            position: relative;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .vault-container::before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, transparent, var(--accent), transparent, #00a3ff, transparent);
            background-size: 400% 400%;
            z-index: -1;
            border-radius: 26px;
            animation: borderRotate 8s linear infinite;
            opacity: 0.3;
        }

        @keyframes borderRotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .header-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 15px;
            filter: drop-shadow(0 0 10px var(--accent));
        }

        /* Modern Form Elements */
        .form-control {
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid #334155;
            color: #fff !important;
            border-radius: 12px;
            padding: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 20px var(--accent-dim);
            transform: translateY(-2px);
        }

        #snippet {
            font-family: 'Fira Code', monospace;
            font-size: 14px;
            line-height: 1.6;
            color: var(--accent) !important;
        }

        /* Buttons Styling */
        .btn-action {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-save { background: var(--accent); color: #000; }
        .btn-save:hover { background: #00e692; transform: scale(1.05); box-shadow: 0 0 20px rgba(0, 255, 163, 0.4); }

        .btn-unlock { background: #1e293b; color: #fff; border: 1px solid #334155; }
        .btn-unlock:hover { background: #334155; border-color: var(--accent); color: var(--accent); }

        .btn-clear { background: rgba(255, 75, 75, 0.1); color: #ff4b4b; border: 1px solid rgba(255, 75, 75, 0.2); }
        .btn-clear:hover { background: #ff4b4b; color: #fff; }

        .security-tag {
            background: var(--accent-dim);
            color: var(--accent);
            padding: 5px 15px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <div class="vault-container">
                <div class="text-center">
                    <i class="fas fa-fingerprint header-icon"></i>
                    <h2 class="fw-bold mb-1">CyberVault</h2>
                    <div class="security-tag">Military Grade Encryption</div>
                </div>

                <div class="mb-4 mt-3">
                    <label class="small text-muted mb-2 ms-2">Access Key</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 text-muted">
                            <i class="fas fa-shield-alt"></i>
                        </span>
                        <input type="password" id="password" class="form-control" placeholder="••••••••">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="small text-muted mb-2 ms-2">Encrypted Snippet</label>
                    <textarea id="snippet" class="form-control" rows="8" placeholder="// Your secret code goes here..."></textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-5">
                        <button class="btn btn-action btn-save w-100" onclick="saveSnippet()">
                            <i class="fas fa-lock"></i> Secure Save
                        </button>
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-action btn-unlock w-100" onclick="loadSnippet()">
                            <i class="fas fa-key"></i> Unlock Data
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-action btn-clear w-100" title="Wipe Everything" onclick="clearSnippet()">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>

            <p class="text-center mt-4 text-muted small">
                <i class="fas fa-terminal me-2"></i> Local Storage: <span id="storageSize">0.00</span> KB Used
            </p>
        </div>
    </div>
</div>

<script>
    // Local storage size tracker
    function updateSize() {
        let size = (JSON.stringify(localStorage).length / 1024).toFixed(2);
        document.getElementById('storageSize').innerText = size;
    }

    // Save Snippet
    function saveSnippet() {
        let pass = document.getElementById("password").value;
        let code = document.getElementById("snippet").value;

        if(!pass || !code) {
            alert("Please fill in both fields!");
            return;
        }

        localStorage.setItem("v_pass", pass);
        localStorage.setItem("v_data", btoa(code)); 
        updateSize();
        alert("Encrypted successfully!");
    }

    // Load Snippet
    function loadSnippet() {
        let pass = document.getElementById("password").value;
        let savedPass = localStorage.getItem("v_pass");

        if(pass && pass === savedPass) {
            let data = atob(localStorage.getItem("v_data"));
            document.getElementById("snippet").value = data;
        } else {
            alert("Access Denied! Incorrect Key.");
        }
    }

    // Clear
    function clearSnippet() {
        if(confirm("Wipe all data from this vault?")) {
            localStorage.clear();
            document.getElementById("snippet").value = "";
            document.getElementById("password").value = "";
            updateSize();
        }
    }

    // Initial size check
    updateSize();

    // Disable Inspection
    document.addEventListener("contextmenu", e => e.preventDefault());
    document.addEventListener("keydown", function(e) {
        if (e.keyCode == 123 || (e.ctrlKey && e.shiftKey && e.keyCode == 73)) e.preventDefault();
    });
</script>

</body>
</html>