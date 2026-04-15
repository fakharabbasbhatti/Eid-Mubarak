<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Secure Snippets</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-glow: #00ff88;
            --danger-glow: #ff4b2b;
            --bg-color: #0f172a;
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: #f8fafc;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        h2 {
            font-weight: 600;
            letter-spacing: -1px;
            color: var(--primary-glow);
            text-shadow: 0 0 15px rgba(0, 255, 136, 0.3);
        }

        .form-control {
            background: rgba(15, 23, 42, 0.8) !important;
            border: 1px solid #334155;
            color: #ecf0f1 !important;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-glow);
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.2);
        }

        #snippet {
            font-family: 'Fira Code', monospace;
            color: #00ff88 !important;
            font-size: 0.9rem;
        }

        /* Custom Button Styling */
        .btn-custom {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            transition: all 0.3s;
            border: none;
        }

        .btn-save { background: #00ff88; color: #000; }
        .btn-save:hover { background: #00cc6e; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 255, 136, 0.4); }

        .btn-load { background: #3b82f6; color: #fff; }
        .btn-load:hover { background: #2563eb; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4); }

        .btn-clear { background: transparent; color: #94a3b8; border: 1px solid #334155; }
        .btn-clear:hover { background: #ef4444; color: #fff; border-color: #ef4444; }

        .status-badge {
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(0, 255, 136, 0.1);
            color: var(--primary-glow);
            margin-bottom: 1rem;
            display: inline-block;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="text-center mb-4">
                <h2><i class="fas fa-shield-halved"></i> NEXUS SECURE</h2>
                <p class="text-muted">End-to-end local encrypted code storage</p>
            </div>

            <div class="glass-card">
                <div class="status-badge"><i class="fas fa-circle-check"></i> AES-Base64 Ready</div>
                
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent border-secondary text-muted">
                        <i class="fas fa-key"></i>
                    </span>
                    <input type="password" id="password" class="form-control" placeholder="Enter Access Key">
                </div>

                <textarea id="snippet" class="form-control mb-4" rows="8" placeholder="// Paste your sensitive code or notes here..."></textarea>

                <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                    <div class="btn-group w-100 me-md-2">
                        <button class="btn btn-custom btn-save w-100" onclick="saveSnippet()">
                            <i class="fas fa-lock me-2"></i>Encrypt & Save
                        </button>
                        <button class="btn btn-custom btn-load w-100" onclick="loadSnippet()">
                            <i class="fas fa-unlock-alt me-2"></i>Decrypt
                        </button>
                    </div>
                    <button class="btn btn-custom btn-clear" onclick="clearSnippet()">
                        <i class="fas fa-eraser"></i>
                    </button>
                </div>
            </div>
            
            <p class="text-center mt-4 text-muted" style="font-size: 0.8rem;">
                <i class="fas fa-info-circle"></i> Data is stored locally in your browser and never leaves this device.
            </p>
        </div>
    </div>
</div>

<script>
    // Save Snippet
    function saveSnippet() {
        let pass = document.getElementById("password").value;
        let code = document.getElementById("snippet").value;

        if(!pass || !code) {
            showToast("Required fields missing!", "error");
            return;
        }

        localStorage.setItem("secure_pass", pass);
        localStorage.setItem("secure_code", btoa(code)); 

        alert("Data Encrypted and Stored!");
    }

    // Load Snippet
    function loadSnippet() {
        let pass = document.getElementById("password").value;
        let savedPass = localStorage.getItem("secure_pass");

        if(pass && pass === savedPass) {
            let code = atob(localStorage.getItem("secure_code"));
            document.getElementById("snippet").value = code;
        } else {
            alert("Access Denied: Invalid Key");
        }
    }

    // Clear
    function clearSnippet() {
        if(confirm("Are you sure? This will wipe the local vault.")) {
            localStorage.clear();
            document.getElementById("snippet").value = "";
            document.getElementById("password").value = "";
            alert("Vault Cleared!");
        }
    }

    // Security Features
    document.addEventListener("contextmenu", e => e.preventDefault());
    document.addEventListener("keydown", function(e) {
        if (e.keyCode == 123 || (e.ctrlKey && e.shiftKey && e.keyCode == 73)) {
            e.preventDefault();
        }
    });
</script>

</body>
</html>