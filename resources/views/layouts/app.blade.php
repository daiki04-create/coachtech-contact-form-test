<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    @yield('css')
    <style>
        body { font-family: 'serif'; margin: 0; padding: 0; color: #8b7969; }
        
        header { 
            display: flex; 
            justify-content: center;
            align-items: center; 
            padding: 30px 50px;
            border-bottom: 1px solid #eee;
            position: relative;
            min-height: 40px;
        }

        .header-logo { 
            font-size: 32px; 
            font-weight: bold; 
            text-decoration: none; 
            color: #8b7969;
            letter-spacing: 2px;
            transition: opacity 0.3s;
        }

        .header-logo:hover {
            opacity: 0.7;
        }

        .header-right {
            position: absolute;
            right: 50px;
        }
        
        main { padding: 50px; max-width: 1200px; margin: 0 auto; }
        
        button, .btn {
            background: #8b7969;
            color: white;
            border: none;
            padding: 5px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        .modal {
            display: none; 
            position: fixed;
            z-index: 100;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal:target { display: block; } 
        
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            width: 50%;
            position: relative;
        }
    </style>
</head>
<body>
    <header>
        <a class="header-logo" href="/">FashionablyLate</a>

        <div class="header-right">
            @yield('header-right')
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>