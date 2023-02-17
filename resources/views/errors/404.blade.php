<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Custom Error Page Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        animation: colorSlide 15s cubic-bezier(0.075, 0.82, 0.165, 1) infinite;
    }

    .container {
        width: 35%;
        text-align: center;
    }

    .container h1 {
        font-size: 24px;
    }

    .container .game-pad {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        width: 60%;
        margin: auto;
        margin-top: 2rem;
    }

    .container .game-pad input {
        background-color: rgb(232, 231, 231);
        border: 1px solid burlywood;
        outline: none;
        font-size: 24px;
        width: 80px;
        height: 80px;
        margin-bottom: 10px;
        cursor: pointer;
        text-align: center;
    }

    .container .game-pad .click {
        border: 2px solid black;
    }

    .container p {
        color: white;
        width: 60%;
        text-align: center;
        margin: auto;
        margin-top: 1rem;
        padding: 3px 2px;
        font-weight: 600;
        transition: 0.3s;
    }

    .container .status {
        animation: notwin 0.1s ease normal 6;
    }

    @keyframes notwin {
        0% {
            transform: translateX(5px);
        }

        100% {
            transform: translateX(-5px);
        }
    }

    .container button {
        background-color: black;
        color: white;
        font-size: 18px;
        padding: 3px 8px;
        transition: 0.1s;
        margin-top: 1rem;
        visibility: hidden;
        border:none;
    }

    .container button:hover {
        background-color: rgb(255, 255, 255);
        color: black;
    }

    .container .active {
        visibility: visible;
    }

    .container .disable {
        pointer-events: none;
    }

    @keyframes colorSlide {
        0% {
            background-color: #152a68;
        }

        25% {
            background-color: royalblue;
        }

        50% {
            background-color: seagreen;
        }

        75% {
            background-color: tomato;
        }

        100% {
            background-color: #152a68;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        ;

        100% {
            opacity: 1;
        }
    }

    .flex-container {
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        animation: colorSlide 15s cubic-bezier(0.075, 0.82, 0.165, 1) infinite;
    }

    .text-center {
        text-align: center;
    }

    .text-center h1,
    h3 {
        margin: 10px;
        cursor: default;
    }

    .fade-in {
        animation: fadeIn 2s ease infinite;
    }

    .text-center h1 {
        font-size: 8em;
        transition: font-size 200ms ease-in-out;
        border-bottom: 1px dashed white;
    }

    .text-center h1 span#digit1 {
        animation-delay: 200ms;
    }

    .text-center h1 span#digit2 {
        animation-delay: 300ms;
    }

    .text-center h1 span#digit3 {
        animation-delay: 400ms;
    }

    @media only screen and (min-width: 901px) and (max-width: 1300px) {
        .container {
            min-width: 40%;
            max-width: 50%;
        }
    }

    @media only screen and (min-width: 641px) and (max-width: 900px) {
        .container {
            min-width: 55%;
            max-width: 60%;
        }
    }

    @media only screen and (max-width: 640px) {
        .container {
            max-width: 90%;
            min-width: 80%;
        }
    }

    @media only screen and (max-width: 500px) {
        .flex-container .text-center h1 {
            font-size: 5em;
            transition: font-size 200ms ease-in-out;
            border-bottom: 1px dashed white;
        }

        .flex-container .text-center h3 {
            font-size: 1em;
        }

        .container .game-pad input {
            width: 62px;
            height: 64px;
        }
    }
</style>

<body>
    <div class="container">
        <div class="flex-container">
            <div class="text-center">
                <h1>
                    <span class="fade-in" id="digit1">4</span>
                    <span class="fade-in" id="digit2">0</span>
                    <span class="fade-in" id="digit3">4</span>
                </h1>
                <h3 class="fadeIn">PAGE NOT FOUND</h3>
                <strong><a href="{{url('/')}}" style="text-decoration: none; color:#f82249" name="button">Return To Home</a></strong>
            </div>
        </div>
        <p id="Status">Play Now</p>
        <section class="game-pad">
            <input type="text" id="b1" readonly />
            <input type="text" id="b2" readonly />
            <input type="text" id="b3" readonly />
            <input type="text" id="b4" readonly />
            <input type="text" id="b5" readonly />
            <input type="text" id="b6" readonly />
            <input type="text" id="b7" readonly />
            <input type="text" id="b8" readonly />
            <input type="text" id="b9" readonly />
        </section>
        <button class="restart-btn" style="color: #f82249">Restart</button>
    </div>
    <script>
        const random = () => {
            return Math.round(Math.random())
        };
        let flag = 1;
        const allBtn = document.querySelector('.game-pad'),
            statusBar = document.getElementById('Status'),
            allInput = allBtn.querySelectorAll('input'),
            restartBtn = document.querySelector('.container .restart-btn')
        let [a1, a2, a3, a4, a5, a6, a7, a8, a9] = document.querySelectorAll('.game-pad input');
        let b1, b2, b3, b4, b5, b6, b7, b8, b9;

        //Show 'X' or 'O' when click the button
        const valueSetting = (input) => {
            if (input.disabled) {
                return;
            }
            if (flag == 1) {
                input.value = 'X';
                input.disabled = true;
                flag = 0;
            } else {
                input.value = 'O';
                input.disabled = true;
                flag = 1;
            }
            checkWinner()
        };

        //Winning animation
        const fieldMatch = (inputField) => {
            if (Array.isArray(inputField)) {
                inputField.forEach(elem => elem.style.backgroundColor = '#f82249')
            } else {
                allInput.forEach(elem => elem.style.backgroundColor = '#f82249')
            }
        };

        //Winner Checking Function
        const checkWinner = () => {
            b1 = a1.value;
            b2 = a2.value;
            b3 = a3.value;
            b4 = a4.value;
            b5 = a5.value;
            b6 = a6.value;
            b7 = a7.value;
            b8 = a8.value;
            b9 = a9.value;

            //Check Player 'X' win
            if (b1 == 'X' && b2 == 'X' && b3 == 'X') {
                winner('X', [a1, a2, a3])
            } else if (b1 == 'X' && b4 == 'X' && b7 == 'X') {
                winner('X', [a1, a4, a7])
            } else if (b1 == 'X' && b5 == 'X' && b9 == 'X') {
                winner('X', [a1, a5, a9])
            } else if (b2 == 'X' && b5 == 'X' && b8 == 'X') {
                winner('X', [a2, a5, a8])
            } else if (b3 == 'X' && b6 == 'X' && b9 == 'X') {
                winner('X', [a3, a6, a9])
            } else if (b3 == 'X' && b5 == 'X' && b7 == 'X') {
                winner('X', [a3, a5, a7])
            } else if (b4 == 'X' && b5 == 'X' && b6 == 'X') {
                winner('X', [a4, a5, a6])
            } else if (b7 == 'X' && b8 == 'X' && b9 == 'X') {
                winner('X', [a7, a8, a9])
            }
            //Check Player 'O' win
            else if (b1 == 'O' && b2 == 'O' && b3 == 'O') {
                winner('O', [a1, a2, a3])
            } else if (b1 == 'O' && b4 == 'O' && b7 == 'O') {
                winner('X', [a1, a4, a7])
            } else if (b1 == 'O' && b5 == 'O' && b9 == 'O') {
                winner('O', [a1, a5, a9])
            } else if (b2 == 'O' && b5 == 'O' && b8 == 'O') {
                winner('O', [a2, a5, a8])
            } else if (b3 == 'O' && b6 == 'O' && b9 == 'O') {
                winner('O', [a3, a6, a9])
            } else if (b3 == 'O' && b5 == 'O' && b7 == 'O') {
                winner('O', [a3, a5, a7])
            } else if (b4 == 'O' && b5 == 'O' && b6 == 'O') {
                winner('O', [a4, a5, a6])
            } else if (b7 == 'O' && b8 == 'O' && b9 == 'O') {
                winner('O', [a7, a8, a9])
            }
            //Check not any winner
            else if ((b1 == 'X' || b1 == 'O') && (b2 == 'X' || b2 == 'O') && (b3 == 'X' || b3 == 'O') && (b4 == 'X' || b4 == 'O') && (b5 == 'X' || b5 == 'O') && (b6 == 'X' || b6 == 'O') && (b7 == 'X' || b7 == 'O') && (b8 == 'X' || b8 == 'O') && (b9 == 'X' || b9 == 'O')) {
                winner('match', false)
            }
        };

        //Change status & push game after any one winner or match
        const winner = (winer, inputField) => {
            fieldMatch(inputField)
            if (winer == 'X') {
                statusBar.innerText = "Player 'X' won"
                statusBar.style.color = '#f82249'
                pause()
            } else if (winer == 'O') {
                statusBar.innerText = "Player 'O' won"
                statusBar.style.color = '#f82249'
                pause()
            } else {
                statusBar.innerText = "DRAW"
                statusBar.style.color = 'red'
                statusBar.classList.add('status')
                setTimeout(restart, 3000)
            }
        };

        //Game pause function
        const pause = () => {
            allInput.forEach(elem => elem.disabled = true)
        };

        //Restart function
        const restart = () => {
            allInput.forEach(elem => {
                elem.value = '';
                elem.disabled = false;
                elem.classList.remove('click')
                elem.style.backgroundColor = 'rgb(232, 231, 231)'
            });
            statusBar.innerText = "Play now"
            statusBar.style.color = 'white'
            statusBar.classList.remove('status')
            restartBtn.classList.remove('active')
        }

        //Get clicked fields
        allBtn.addEventListener('click', (e) => {
            if (e.target.matches('input')) {
                let input = e.target;
                valueSetting(input)
                e.target.classList.add('click')
                restartBtn.classList.add('active')
            }
        })

        //Call restart function when click button
        restartBtn.addEventListener('click', restart)
    </script>
</body>

</html>