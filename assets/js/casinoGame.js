import Swal from "sweetalert2";
const chosenGamble = document.getElementById('game_form_Mise');
const chosenColor = document.getElementById('game_form_Couleur');
const resultGame = document.getElementById('game_gain');
const playBtn = document.getElementById('playGameBtn');

let gamble = null;
let color = null;
let totalAmount = 100;
resultGame.innerHTML = totalAmount;

function gaming() {
        const url = '/wild/play';
        fetch(
            url,
            {
                method: 'post',
                headers: {
                    Accept: 'application/json',
                    'Content-type': 'application/json',
                },
                body: JSON.stringify({
                    gamble,
                    color,
                    totalAmount,
                }),
            },
        )
            .then(response => response.json())
            .then((htmlContent) => {
                resultGame.innerHTML = `${htmlContent.gameIssue}`;
                totalAmount = resultGame.innerHTML;
                if (totalAmount <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Vous avez perdu !',
                        allowOutsideClick: false
                    }) .then (function () {
                        window.location.replace('/');
                    });
                } else if (totalAmount >= 300) {
                    Swal.fire({
                        title: 'Vous avez gagné une place !',
                        allowOutsideClick: false
                    }).then (function () {
                        window.location.replace('/');
                    });
                }
            });
}

chosenGamble.addEventListener('change', (event) => {
    gamble = event.target.value;
});
chosenColor.addEventListener('change', (event) => {
    color = event.target.value;
});
playBtn.addEventListener('click', () => {
    gaming();
});

