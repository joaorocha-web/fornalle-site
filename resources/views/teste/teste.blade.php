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
    

    <script>
        const screen = document.getElementById('screen')
        const ctx = screen.getContext('2d')

        

        const game = {
            players: {
                'player1': {x:1, y:2},
                'player2' : {x:4, y:4}
            },

            fruits: {
                'fruit1' : {x:2, y:3}
            }
        }

        document.addEventListener('keydown', handleKeydown)

        function handleKeydown(event){
            const keyPressed = event.key
            const player = game.players['player1']
            if(keyPressed === 'ArrowUp' && player.y - 1 >=0){
                player.y = player.y - 1
            }
            if(keyPressed === 'ArrowDown' && player.y + 1 <=9){
                player.y = player.y + 1
            }
            if(keyPressed === 'ArrowLeft' && player.x - 1 >=0){
                player.x = player.x - 1
            }
            if(keyPressed === 'ArrowRight' && player.x + 1 <=9){
                player.x = player.x + 1
            }
        }

        renderGame()

        function renderGame(){
            ctx.fillStyle = 'white'
            ctx.clearRect(0,0, 10, 10)
            for(const playerId in game.players){
                const player = game.players[playerId]
                ctx.fillStyle = 'black'
                ctx.fillRect(player.x, player.y, 1 ,1)
            }
            for(const fruitId in game.fruits){
                const fruit = game.fruits[fruitId]
                ctx.fillStyle = 'green'
                ctx.fillRect(fruit.x, fruit.y, 1,1)
            }

            requestAnimationFrame(renderGame)
        }

        
    </script>
</body>
</html>