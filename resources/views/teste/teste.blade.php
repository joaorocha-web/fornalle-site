<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            background-color: #ccc;
        }

        #screen{
            border: 10px solid black;
            image-rendering: pixelated; 
            image-rendering: crisp-edges;
            image-rendering: -moz-crisp-edges;
            width: 400px;
            height: 400px;
        
        }
    </style>
    
</head>
<body>
    <canvas id="screen" width="10" height="10"></canvas>
    

    <script type="module">
        import createKeyboardListener from '/js/keyboard-listener.js'
        import createGame from '/js/create-game.js'
        import renderScreen from '/js/render-screen.js'
        const screen = document.getElementById('screen')
        const currentPlayerId = 'player1'

        

        const game = createGame()
        const keyboardListener = createKeyboardListener(document)
        keyboardListener.subscribe(game.movePlayer)

        game.addPlayer({playerId:'player1', playerX: 4, playerY: 2})
        game.addPlayer({playerId:'player2', playerX: 1, playerY: 3})
        game.addPlayer({playerId:'player3', playerX: 8, playerY: 0})
        game.addFruit({fruitId:'fruit1', fruitX: 5, fruitY: 7})
        game.addFruit({fruitId:'fruit2', fruitX: 3, fruitY: 9})



       

        renderScreen(screen, game, requestAnimationFrame)

        
        
    </script>
</body>
</html>