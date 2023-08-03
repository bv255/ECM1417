const board = document.getElementById("game");
const start_btn = document.querySelector("#start")
const main = document.querySelector("#main");
start_btn.addEventListener("click", startGame);

function getRandom(list) {
    const randomIndex = Math.floor(Math.random() * list.length);
    return list[randomIndex];
}

class Game {

    constructor() {
        this.card_list = [];
        this.flippedCards = [];
        this.score = 0;
        this.scoreDiv = document.createElement("div");
    }

    compareCards() {

        if(this.flippedCards.length % 2 !== 0) {
            return
        } else {
            const card1 = this.flippedCards[this.flippedCards.length - 1];
            const card2 = this.flippedCards[this.flippedCards.length - 2];
            if (card1.face === card2.face) {
                card1.container.removeEventListener('click', card1.flip);
                card2.container.removeEventListener('click', card2.flip);
                this.score += 5;
                this.scoreDiv.textContent = "Score: " + this.score;

                if(this.flippedCards.length == this.card_list.length) {
                    this.endGame();
                }
            } else {

                this.flippedCards.pop();
                this.flippedCards.pop();
                this.score -= 2;
                this.scoreDiv.textContent = "Score: " + this.score;
                setTimeout(() => {
                    card1.flip();
                    card2.flip();
                }, 1000);
            }
        }
    }

    generateCards() {
        for (let i = 0; i < 3; i++) {
            let card = new Card();
            let card2 = new Card(card.face);
            this.card_list.push(card, card2);
        }
    }

    shuffleCards(cards) {
        for (let i = cards.length - 1; i > 0; i--) {
            const randomIndex = Math.floor(Math.random() * (i + 1));
            [cards[i], cards[randomIndex]] = [cards[randomIndex], cards[i]];
        }
        return cards;
    }

    drawCards() {
        for (const card of this.card_list) {
            card.drawCard();
            card.container.addEventListener('click', () => {
                if (!card.isFlipped) {
                    card.flip();
                    this.flippedCards.push(card);
                    this.compareCards();
                }
            });
        }
    }

    startBoard() {
        this.generateCards();
        this.shuffleCards(this.card_list);
        this.drawCards();

        this.scoreDiv.textContent = "Score: " + this.score;
        this.scoreDiv.classList.add("score");
        main.appendChild(this.scoreDiv);
    }

    saveGame() {
        const submitBtn = document.createElement("button");
        submitBtn.classList.add("btn" , "btn-primary", "btn-lg" , "center");
        submitBtn.innerText = "Submit";
        submitBtn.addEventListener("click", () => {
            // Sends a POST request to the server to save the player's score
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "save_score.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("POST request sent successfully!");
              } else {
                console.log("idiot");
              }
            };
        
            const user = getCookie('username');
            console.log('Username:', user);
            var data = JSON.stringify({username:user, score:this.score});
            xhr.send(data);
        
            // Redirects to the leaderboard page after submitting the score
            window.location.href = "leaderboard.php";
          });
          
        main.appendChild(submitBtn);
    }

    endGame() {
        for(const card of this.card_list) {
            card.container.remove();
        }

        this.scoreDiv.remove();
        this.saveGame();
        main.appendChild(start_btn);
    }


}

class Card {
    static suit = ["♠", "♥", "♦", "♣"];
    static value = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

    constructor(face) {
        this.face = face || getRandom(Card.value) + getRandom(Card.suit);
        this.isFlipped = false;

        this.container = document.createElement("div");
        this.container.classList.add("container");

        this.card = document.createElement("div");
        this.card.classList.add("card");

        this.front = document.createElement("div");
        this.front.classList.add("front");
        this.front.textContent = this.face;

        this.back = document.createElement("div");
        this.back.classList.add("back");
        
        this.card.appendChild(this.front);
        this.card.appendChild(this.back);

        this.container.append(this.card);
    }

    flip() {
        this.isFlipped = !this.isFlipped;
        this.container.classList.toggle('flipped', this.isFlipped);
      }

    drawCard() {
        board.appendChild(this.container);
    }

    
}

function getCookie(cookieName) {
    const cookies = document.cookie.split('; ');
    for (const cookie of cookies) {
      const [name, value] = cookie.split('=');
      if (name === cookieName) {
        // Decode the value using `decodeURIComponent()` as it might be URL-encoded
        return decodeURIComponent(value);
      }
    }
    return null; // Return null if the cookie doesn't exist
  }
  

function startGame() {
    const game = new Game();
    game.startBoard();
    start_btn.remove();
}