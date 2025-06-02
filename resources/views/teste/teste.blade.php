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
        const currentPlayerId = 'player1'

        function createGame(){
            const state = {
                players: {},
                fruits: {} 
            }

            function addPlayer(command){
                const playerId = command.playerId
                const playerX = command.playerX
                const playerY = command.playerY

                state.players[playerId] = {
                    x: playerX,
                    y: playerY
                }
            }

            function removePlayer(command){
                const playerId = command.playerId
                
                delete state.players[playerId]
            }

            function addFruit(command){
                const fruitId = command.fruitId
                const fruitX = command.fruitX
                const fruitY = command.fruitY

                state.fruits[fruitId] = {
                    x: fruitX,
                    y: fruitY
                }
            }

            function removeFruit(command){
                const fruitId = command.fruitId

                delete state.fruits[fruitId]
            }

            function movePlayer(command){
                console.log(`Moving ${command.playerId} with ${command.keyPressed}`)

                const acceptedMoves = {
                    ArrowUp(player) {
                        console.log(`Moving player up`)
                        if(player.y - 1 >=0){
                            player.y = player.y - 1
                        }       
                    },
                    ArrowDown(player) {
                        console.log(`Moving player down`)
                        if(player.y + 1 <=9){
                            player.y = player.y + 1
                        }
                    },
                    ArrowLeft(player) {
                        console.log(`Moving player left`)
                        if(player.x - 1 >=0){
                             player.x = player.x - 1
                        }
                    },
                    ArrowRight(player) {
                        console.log(`Moving player right`)
                        if(player.x + 1 <=9){
                            player.x = player.x + 1
                        }
                    }
                }

                const keyPressed = command.keyPressed
                const player = state.players[command.playerId]
                const moveFunction = acceptedMoves[keyPressed]
                
                if(moveFunction){
                    moveFunction(player)
                }
                return

            }

            return {
                addFruit, 
                removeFruit,
                addPlayer,
                removePlayer,
                movePlayer,
                state
            }
        }

        const game = createGame()
        const keyboardListener = createKeyboardListener()
        keyboardListener.subscribe(game.movePlayer)

        function createKeyboardListener(){
            const state = {
                observers: []
            }

            function subscribe(observerFunction){
                state.observers.push(observerFunction)
            }

            function notifyAll(command){
                console.log(`Notifying ${state.observers.length} observers`)

                for(const observerFunction of state.observers){
                    observerFunction(command)
                }
            }

            document.addEventListener('keydown', handleKeydown)

            function handleKeydown(event){
                const keyPressed = event.key

                const command = {
                    playerId: 'player1',
                    keyPressed
                }

                notifyAll(command)
                
            }

            return{
                subscribe
            }
        }


       

        renderGame()

        function renderGame(){
            ctx.fillStyle = 'white'
            ctx.clearRect(0,0, 10, 10)
            for(const playerId in game.state.players){
                const player = game.state.players[playerId]
                ctx.fillStyle = 'black'
                ctx.fillRect(player.x, player.y, 1 ,1)
            }
            for(const fruitId in game.state.fruits){
                const fruit = game.state.fruits[fruitId]
                ctx.fillStyle = 'green'
                ctx.fillRect(fruit.x, fruit.y, 1,1)
            }

            requestAnimationFrame(renderGame)
        }
,
        
    </script>
</body>
</html>