<header class="header">
    <div class="sidebar">
        <div class="sb-top">
            <button class="sb-options">☰</button>
        </div>
        
        <div class="sb-pages">
            
        </div>
    </div>
    
    <div class="top">
        <div class="logo">
            <strong>PokeMarket TCG</strong>
            <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
        </div>
        
        <div class="user">
            <div class="info">
                <strong>Renee McKelvey</strong>
                <span>Production Manager</span>
            </div>
            <img src="{{ asset('imagenes/usuario.png') }}" alt="User">
        </div>
    </div>
</header>

<style>
    body {
        width: 100%;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin-top: 65px;
        padding-left: 65px;
    }
    
    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
    }
    
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .sb-top {
        width: 65px;
        height: 65px;
        background-color: #333333;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .sb-options {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }
    
    .sb-pages {
        width: 65px;
        height: calc(100vh - 65px);
        background-color: #f0f0f0;
        border-right: 1px solid #e0e0e0;
    }
    
    .top {
        position: fixed;
        top: 0;
        left: 65px; 
        right: 0;
        height: 65px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #d6d6d6;
        padding: 0 20px;
    }
    
    .logo {
        display: flex;
        align-items: center;
        font-size: 24px;
    }
    
    .logo img {
        width: 40px;
        height: auto;
        margin-left: 10px;
    }
    
    .user {
        display: flex;
        align-items: center;
        text-align: right;
    }
    
    .user .info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    
    .user .info span {
        color: #888888;
        font-size: 14px;
    }
    
    .user img {
        width: 40px;
        height: auto;
        margin-left: 10px;
        border-radius: 50%;
    }
</style>